<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;   
use Illuminate\Support\Facades\Auth; 

class TareaController extends Controller
{
    // --- MOSTRAR LISTA (Solo mis tareas) ---
    public function index()
    {
        // Obtenemos el ID del usuario conectado
        $userId = Auth::id(); 

        $tareas = DB::table('tareas')
            // Unimos con categorías para ver el nombre (ej: "Trabajo")
            ->join('categorias', 'tareas.categoria_id', '=', 'categorias.id')
            ->select('tareas.*', 'categorias.nombre as nombre_categoria')
            // FILTRO DE SEGURIDAD: Solo las tareas de este usuario
            ->where('tareas.user_id', $userId) 
            ->get();
        
        return view('tareas.index', compact('tareas'));
    }

    // --- FORMULARIO CREAR ---
    public function create()
    {
        // ANTES: $categorias = DB::table('categorias')->get();
        // AHORA: Solo traemos las mías
        $categorias = DB::table('categorias')->where('user_id', Auth::id())->get();

        return view('tareas.create', compact('categorias'));
    }

    // --- GUARDAR NUEVA TAREA ---
    public function store(Request $request)
    {
        DB::table('tareas')->insert([
            'titulo'       => $request->input('titulo'),
            'descripcion'  => $request->input('descripcion'),
            'fecha'        => $request->input('fecha'),
            'categoria_id' => $request->input('categoria_id'),
            //  FIRMA: Guardamos que esta tarea la creó el usuario actual
            'user_id'      => Auth::id() 
        ]);

        // Redirigimos con un mensaje de éxito
        return redirect()->route('tareas.index')->with('mensaje', '¡Tarea creada exitosamente!');
    }

    // --- VER DETALLE (Blindado) ---
    public function show($id)
    {
        $tarea = DB::table('tareas')
            ->leftJoin('categorias', 'tareas.categoria_id', '=', 'categorias.id')
            ->select('tareas.*', 'categorias.nombre as nombre_categoria')
            ->where('tareas.id', $id)
            ->where('tareas.user_id', Auth::id()) // SOLO SI ES MÍA
            ->first();

        // Si la tarea no existe o es de otro usuario, lo sacamos
        if (!$tarea) {
            return redirect()->route('tareas.index');
        }

        return view('tareas.show', compact('tarea'));
    }

    // --- FORMULARIO EDITAR (Blindado) ---
    public function edit($id)
    {
        $tarea = DB::table('tareas')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->first();
        
        if (!$tarea) { return redirect()->route('tareas.index'); }

        // AHORA: Solo traemos las mías en el menú de editar también
        $categorias = DB::table('categorias')->where('user_id', Auth::id())->get();

        return view('tareas.edit', compact('tarea', 'categorias'));
    }

    // --- ACTUALIZAR CAMBIOS (Blindado) ---
    public function update(Request $request, $id)
    {
        // Solo actualizamos si el ID coincide Y el usuario es el dueño
        DB::table('tareas')
            ->where('id', $id)
            ->where('user_id', Auth::id()) //  SEGURIDAD
            ->update([
                'titulo'       => $request->input('titulo'),
                'descripcion'  => $request->input('descripcion'),
                'fecha'        => $request->input('fecha'),
                'categoria_id' => $request->input('categoria_id'),
            ]);

        return redirect()->route('tareas.index')->with('mensaje', 'Tarea actualizada correctamente.');
    }

    // --- ELIMINAR (Blindado) ---
    public function destroy($id)
    {
        // Solo borramos si el usuario es el dueño
        DB::table('tareas')
            ->where('id', $id)
            ->where('user_id', Auth::id()) //  SEGURIDAD
            ->delete();

        return redirect()->route('tareas.index')->with('mensaje', 'Tarea eliminada.');
    }
}
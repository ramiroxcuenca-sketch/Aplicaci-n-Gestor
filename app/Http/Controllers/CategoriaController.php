<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // ✅ Importamos Auth

class CategoriaController extends Controller
{
    // Listar (Solo las mías)
    public function index()
    {
        $categorias = DB::table('categorias')
            ->where('user_id', Auth::id()) // 🔒 SOLO MIS CATEGORÍAS
            ->get();
            
        return view('categorias.index', compact('categorias'));
    }

    // Guardar nueva (Con mi firma)
    public function store(Request $request)
    {
        DB::table('categorias')->insert([
            'nombre' => $request->input('nombre'),
            'user_id' => Auth::id() // 🔒 GUARDAMOS MI ID
        ]);

        return redirect()->route('categorias.index')->with('mensaje', 'Categoría creada.');
    }

    // Editar (Solo si es mía)
    public function edit($id)
    {
        $categoria = DB::table('categorias')
            ->where('id', $id)
            ->where('user_id', Auth::id()) // 🔒 SEGURIDAD
            ->first();

        if (!$categoria) {
            return redirect()->route('categorias.index');
        }

        return view('categorias.edit', compact('categoria'));
    }

    // Actualizar (Solo si es mía)
    public function update(Request $request, $id)
    {
        DB::table('categorias')
            ->where('id', $id)
            ->where('user_id', Auth::id()) // 🔒 SEGURIDAD
            ->update([
                'nombre' => $request->input('nombre')
            ]);
        
        return redirect()->route('categorias.index')->with('mensaje', 'Categoría actualizada.');
    }

    // Eliminar (Solo si es mía)
    public function destroy($id)
    {
        DB::table('categorias')
            ->where('id', $id)
            ->where('user_id', Auth::id()) // 🔒 SEGURIDAD
            ->delete();

        return redirect()->route('categorias.index')->with('mensaje', 'Categoría eliminada.');
    }
}
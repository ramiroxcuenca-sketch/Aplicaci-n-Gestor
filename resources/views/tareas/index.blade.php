@extends('layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="text-primary">Mis Tareas</h2>
    <a href="{{ route('tareas.create') }}" class="btn btn-success">
        <i class="bi bi-plus-lg"></i> Nueva Tarea
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Categoría</th> <th>Título</th>
                    <th>Descripción</th>
                    <th>Fecha Límite</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            @if(session('mensaje'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('mensaje') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>  
            @endif
            <tbody>
                @foreach ($tareas as $tarea)
                    <tr>
                        <td class="fw-bold text-secondary">{{ $tarea->id }}</td>
                        
                        <td>
                            <span class="badge bg-warning text-dark">
                                {{ $tarea->nombre_categoria }}
                            </span>
                        </td>

                        <td class="fw-bold">{{ $tarea->titulo }}</td>
                        <td>{{ $tarea->descripcion }}</td>
                        <td>
                            <span class="badge bg-info text-dark">
                                {{ $tarea->fecha }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="{{ route('tareas.show', $tarea->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <a href="{{ route('tareas.edit', $tarea->id) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST" onsubmit="return confirm('¿Borrar esta tarea?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger border-start-0 rounded-0 rounded-end">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
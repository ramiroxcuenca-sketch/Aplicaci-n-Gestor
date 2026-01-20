@extends('layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">🔍 Detalle de Tarea #{{ $tarea->id }}</h4>
            </div>
            <div class="card-body">
                
                <h2 class="card-title fw-bold mb-3">{{ $tarea->titulo }}</h2>
                
                <div class="mb-4">
                    <span class="badge bg-warning text-dark fs-6">
                        <i class="bi bi-tag-fill"></i> 
                        {{ $tarea->nombre_categoria ?? 'Sin Categoría' }}
                    </span>
                </div>

                <h5 class="text-muted">Descripción:</h5>
                <p class="card-text p-3 bg-light border rounded">
                    {{ $tarea->descripcion }}
                </p>
                
                <div class="d-flex align-items-center mb-4">
                    <i class="bi bi-calendar-event fs-4 text-primary me-2"></i>
                    <span class="fs-5 fw-bold">Fecha Límite: {{ $tarea->fecha }}</span>
                </div>
                
                <hr>
                
                <div class="d-flex gap-2">
                    <a href="{{ route('tareas.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Volver a la lista
                    </a>
                    
                    <a href="{{ route('tareas.edit', $tarea->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil-fill"></i> Editar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
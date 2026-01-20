@extends('layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">📝 Nueva Tarea</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('tareas.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Título</label>
                        <input type="text" name="titulo" class="form-control" placeholder="Ej: Ir al gimnasio" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Descripción</label>
                        <textarea name="descripcion" class="form-control" rows="3" placeholder="Detalles de la tarea..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Categoría</label>
                        <select name="categoria_id" class="form-select">
                            <option value="">-- Selecciona una categoría (Opcional) --</option>
                            @foreach($categorias as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Fecha Límite</label>
                        <input type="date" name="fecha" class="form-control" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">Guardar Tarea</button>
                        <a href="{{ route('tareas.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
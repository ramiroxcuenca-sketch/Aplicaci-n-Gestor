@extends('layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow border-0">
            <div class="card-header bg-warning">
                <h4 class="mb-0 text-dark">✏️ Editar Tarea</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('tareas.update', $tarea->id) }}" method="POST">
                    @csrf
                    @method('PUT') <div class="mb-3">
                        <label class="form-label fw-bold">Título</label>
                        <input type="text" name="titulo" class="form-control" value="{{ $tarea->titulo }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Descripción</label>
                        <textarea name="descripcion" class="form-control" rows="3">{{ $tarea->descripcion }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Categoría</label>
                        <select name="categoria_id" class="form-select">
                            <option value="">-- Sin Categoría --</option>
                            @foreach($categorias as $cat)
                                <option value="{{ $cat->id }}" 
                                    {{-- Esta línea comprueba: ¿Es esta la categoría de la tarea? Si sí, la selecciona --}}
                                    {{ $tarea->categoria_id == $cat->id ? 'selected' : '' }}>
                                    
                                    {{ $cat->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Fecha Límite</label>
                        <input type="date" name="fecha" class="form-control" value="{{ $tarea->fecha }}" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        <a href="{{ route('tareas.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
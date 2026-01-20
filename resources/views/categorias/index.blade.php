@extends('layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="text-center mb-4">Gestionar Categorías</h2>
        
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form action="{{ route('categorias.store') }}" method="POST" class="d-flex gap-2">
                    @csrf
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre nueva categoría (Ej: Trabajo)" required>
                    <button type="submit" class="btn btn-success">Crear</button>
                </form>
            </div>
        </div>

        <ul class="list-group shadow-sm">
            @foreach($categorias as $cat)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    
                    <span class="fw-bold">{{ $cat->nombre }}</span>

                    <div class="d-flex gap-2">
                        <a href="{{ route('categorias.edit', $cat->id) }}" class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-pencil-fill"></i>
                        </a>

                        <form action="{{ route('categorias.destroy', $cat->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Seguro que quieres borrar esta categoría?')">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </div>

                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
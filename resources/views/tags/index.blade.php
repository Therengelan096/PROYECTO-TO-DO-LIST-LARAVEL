@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Etiquetas</h2>
    <a href="{{ route('tags.create') }}" class="btn btn-primary">Nueva Etiqueta</a>
</div>

<table class="table table-white table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tags as $tag)
        <tr>
            <td>{{ $tag->id }}</td>
            <td>{{ $tag->name }}</td>
            <td>
                <a href="{{ route('tags.show', $tag) }}" class="btn btn-sm btn-info text-white">Ver</a>
                <a href="{{ route('tags.edit', $tag) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('tags.destroy', $tag) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar etiqueta?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h3">Etiquetas</h2>
    <a href="{{ route('tags.create') }}" class="btn btn-primary">Nueva Etiqueta</a>
</div>

<div class="table-responsive bg-white rounded shadow-sm">
    <table class="table table-striped align-middle mb-0">
        <thead class="table-dark">
            <tr>
                <th style="width: 10%;">ID</th>
                <th style="width: 60%;">Nombre</th>
                <th style="width: 30%;" class="text-end">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tags as $tag)
            <tr>
                <td>{{ $tag->id }}</td>
                <td class="text-break-word">
                    <span class="badge bg-info text-dark badge-responsive">{{ $tag->name }}</span>
                </td>
                <td class="text-end text-nowrap">
                    <a href="{{ route('tags.show', $tag) }}" class="btn btn-sm btn-info text-white">Ver</a>
                    <a href="{{ route('tags.edit', $tag) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('tags.destroy', $tag) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar etiqueta?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center text-muted py-3">No hay etiquetas registradas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
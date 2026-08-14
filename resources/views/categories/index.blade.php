@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h3">Categorías</h2>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Nueva Categoría</a>
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
            @forelse($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td class="text-break-word">
                    <span class="badge bg-secondary badge-responsive">{{ $category->name }}</span>
                </td>
                <td class="text-end text-nowrap">
                    <a href="{{ route('categories.show', $category) }}" class="btn btn-sm btn-info text-white">Ver</a>
                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar categoría?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center text-muted py-3">No hay categorías registradas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
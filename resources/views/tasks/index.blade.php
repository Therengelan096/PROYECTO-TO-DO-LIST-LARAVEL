@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h3">Lista de Tareas</h2>
    <a href="{{ route('tasks.create') }}" class="btn btn-success">Nueva Tarea</a>
</div>

<div class="table-responsive bg-white rounded shadow-sm">
    <table class="table table-striped align-middle mb-0">
        <thead class="table-dark">
            <tr>
                <th>Título</th>
                <th>Categoría</th>
                <th>Etiquetas</th>
                <th>Estado</th>
                <th class="text-end">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tasks as $task)
            <tr>
                <td class="text-break-word fw-bold">{{ $task->title }}</td>
                <td>
                    <span class="badge bg-secondary badge-responsive">
                        {{ $task->category->name ?? 'Sin Categoría' }}
                    </span>
                </td>
                <td style="max-width: 200px;">
                    @forelse($task->tags as $tag)
                        <span class="badge bg-info text-dark badge-responsive mb-1">{{ $tag->name }}</span>
                    @empty
                        <span class="text-muted small">Sin etiquetas</span>
                    @endforelse
                </td>
                <td>
                    @if($task->completed)
                        <span class="badge bg-success">Completada</span>
                    @else
                        <span class="badge bg-warning text-dark">Pendiente</span>
                    @endif
                </td>
                <td class="text-end text-nowrap">
                    <a href="{{ route('tasks.show', $task) }}" class="btn btn-sm btn-info text-white">Ver</a>
                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar tarea?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted py-3">No hay tareas registradas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
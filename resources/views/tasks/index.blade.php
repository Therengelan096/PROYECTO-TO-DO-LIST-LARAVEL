@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Lista de Tareas</h2>
    <a href="{{ route('tasks.create') }}" class="btn btn-success">Nueva Tarea</a>
</div>

<table class="table table-white table-striped align-middle">
    <thead>
        <tr>
            <th>Título</th>
            <th>Categoría</th>
            <th>Etiquetas</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tasks as $task)
        <tr>
            <td><strong>{{ $task->title }}</strong></td>
            <td><span class="badge bg-secondary">{{ $task->category->name }}</span></td>
            <td>
                @foreach($task->tags as $tag)
                    <span class="badge bg-info text-dark">{{ $tag->name }}</span>
                @endforeach
            </td>
            <td>
                @if($task->is_completed)
                    <span class="badge bg-success">Completada</span>
                @else
                    <span class="badge bg-warning text-dark">Pendiente</span>
                @endif
            </td>
            <td>
                <a href="{{ route('tasks.show', $task) }}" class="btn btn-sm btn-info text-white">Ver</a>
                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta tarea?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
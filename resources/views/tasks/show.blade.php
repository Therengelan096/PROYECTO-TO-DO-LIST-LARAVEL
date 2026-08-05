@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>{{ $task->title }}</h3>
        @if($task->is_completed)
            <span class="badge bg-success">Completada</span>
        @else
            <span class="badge bg-warning text-dark">Pendiente</span>
        @endif
    </div>
    <div class="card-body">
        <p><strong>Descripción:</strong> {{ $task->description ?? 'Sin descripción.' }}</p>
        <p><strong>Categoría:</strong> <span class="badge bg-secondary">{{ $task->category->name }}</span></p>
        <p><strong>Etiquetas:</strong> 
            @foreach($task->tags as $tag)
                <span class="badge bg-info text-dark">{{ $tag->name }}</span>
            @endforeach
        </p>
        <hr>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>
@endsection
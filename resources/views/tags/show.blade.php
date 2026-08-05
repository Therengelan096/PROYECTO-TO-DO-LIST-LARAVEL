@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Etiqueta: {{ $tag->name }}</h3>
    </div>
    <div class="card-body">
        <p><strong>ID:</strong> {{ $tag->id }}</p>
        <p><strong>Fecha de Creación:</strong> {{ $tag->created_at }}</p>
        <a href="{{ route('tags.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>
@endsection
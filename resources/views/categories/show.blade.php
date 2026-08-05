@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Categoría: {{ $category->name }}</h3>
    </div>
    <div class="card-body">
        <p><strong>ID:</strong> {{ $category->id }}</p>
        <p><strong>Fecha de Creación:</strong> {{ $category->created_at }}</p>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>
@endsection
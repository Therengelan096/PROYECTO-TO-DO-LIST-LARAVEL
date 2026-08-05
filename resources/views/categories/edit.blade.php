@extends('layouts.app')

@section('content')
<h2>Editar Categoría</h2>

<form action="{{ route('categories.update', $category) }}" method="POST" class="bg-white p-4 rounded shadow-sm">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Nombre de la Categoría</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name) }}" required>
        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>
    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
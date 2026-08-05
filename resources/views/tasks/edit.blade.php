@extends('layouts.app')

@section('content')
<h2>Editar Tarea</h2>

<form action="{{ route('tasks.update', $task->id) }}" method="POST" class="bg-white p-4 rounded shadow-sm mb-4">
    @csrf
    @method('PUT')
    
    <div class="mb-3">
        <label for="title" class="form-label">Título de la Tarea</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $task->title) }}" required>
        @error('title') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Descripción</label>
        <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $task->description) }}</textarea>
    </div>

    <div class="mb-3">
        <label for="category_id" class="form-label">Categoría</label>
        <select name="category_id" id="category_id" class="form-select" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $task->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3">
        <label for="tags" class="form-label">Etiquetas (Mantén presionado Ctrl / Cmd para seleccionar varias)</label>
        <select name="tags[]" id="tags" class="form-select" multiple>
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}" {{ (collect(old('tags'))->contains($tag->id) || $task->tags->contains($tag->id)) ? 'selected' : '' }}>
                    {{ $tag->name }}
                </option>
            @endforeach
        </select>
        @error('tags') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" name="is_completed" class="form-check-input" id="is_completed" value="1"
            {{ old('is_completed', $task->is_completed) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_completed">Marcar como realizada</label>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar Tarea</button>
    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
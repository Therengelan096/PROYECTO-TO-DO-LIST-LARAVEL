<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Http\Requests\Api\TagRequest;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();

        if ($tags->isEmpty()) {
            return response()->json([
                'message' => 'No hay registros de etiquetas',
                'status' => 200
            ], 200);
        }

        return response()->json([
            'tags' => $tags,
            'status' => 200
        ], 200);
    }

    public function store(TagRequest $request)
    {
        $tag = Tag::create($request->validated());

        return response()->json([
            'message' => 'Etiqueta creada',
            'tag' => $tag,
            'status' => 201
        ], 201);
    }

    public function show($id)
    {
        $tag = Tag::find($id);

        if (!$tag) {
            return response()->json([
                'message' => 'Etiqueta no encontrada',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'tag' => $tag,
            'status' => 200
        ], 200);
    }

    public function update(TagRequest $request, $id)
    {
        $tag = Tag::find($id);

        if (!$tag) {
            return response()->json([
                'message' => 'Etiqueta no encontrada',
                'status' => 404
            ], 404);
        }

        $tag->update($request->validated());

        return response()->json([
            'message' => 'Etiqueta actualizada',
            'tag' => $tag,
            'status' => 200
        ], 200);
    }

    public function destroy($id)
    {
        $tag = Tag::find($id);

        if (!$tag) {
            return response()->json([
                'message' => 'Etiqueta no encontrada',
                'status' => 404
            ], 404);
        }

        $tag->delete();

        return response()->json([
            'message' => 'Etiqueta eliminada',
            'status' => 200
        ], 200);
    }
}
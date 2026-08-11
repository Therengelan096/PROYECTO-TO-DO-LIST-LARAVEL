<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\Api\CategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            return response()->json([
                'message' => 'No hay registros de categorias',
                'status' => 200
            ], 200);
        }

        return response()->json([
            'categories' => $categories,
            'status' => 200
        ], 200);
    }

    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());

        return response()->json([
            'message' => 'Categoria creada',
            'category' => $category,
            'status' => 201
        ], 201);
    }

    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'message' => 'Categoria no encontrada',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'category' => $category,
            'status' => 200
        ], 200);
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'message' => 'Categoria no encontrada',
                'status' => 404
            ], 404);
        }

        $category->update($request->validated());

        return response()->json([
            'message' => 'Categoria actualizada',
            'category' => $category,
            'status' => 200
        ], 200);
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'message' => 'Categoria no encontrada',
                'status' => 404
            ], 404);
        }

        $category->delete();

        return response()->json([
            'message' => 'Categoria eliminada',
            'status' => 200
        ], 200);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return response()->json(Tag::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:tags,name'
        ]);

        $tag = Tag::create($request->all());

        return response()->json($tag, 201);
    }

    public function show(Tag $tag)
    {
        return response()->json($tag, 200);
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|max:255|unique:tags,name,' . $tag->id
        ]);

        $tag->update($request->all());

        return response()->json($tag, 200);
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return response()->json(['message' => 'Tag deleted successfully'], 200);
    }
}
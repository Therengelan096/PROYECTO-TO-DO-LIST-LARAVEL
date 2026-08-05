<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }
    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:tags,name'
        ]);
        Tag::create($request->all());
        return redirect()->route('tags.index');
    }

    public function show($id)
    {
        $tag = Tag::find($id);
        if (!$tag) {
            return redirect()->route('tags.index')->with('error', 'La etiqueta no existe o ya fue eliminada.');
        }
        return view('tags.show', compact('tag'));
    }

    public function edit($id)
    {
        $tag = Tag::find($id);
        if (!$tag) {
            return redirect()->route('tags.index')->with('error', 'La etiqueta no existe o ya fue eliminada.');
        }
        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $tag = Tag::find($id);
        if (!$tag) {
            return redirect()->route('tags.index')->with('error', 'La etiqueta no existe o ya fue eliminada.');
        }
        $request->validate([
            'name' => 'required|max:255|unique:tags,name,' . $id
        ]);
        $tag->update($request->all());
        return redirect()->route('tags.index');
    }

    public function destroy($id)
    {
        $tag = Tag::find($id);
        if (!$tag) {
            return redirect()->route('tags.index')->with('error', 'La etiqueta ya había sido eliminada.');
        }
        $tag->delete();
        return redirect()->route('tags.index');
    }
}
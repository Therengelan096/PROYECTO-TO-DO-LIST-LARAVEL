<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['category', 'tags'])->get();
        return view('tasks.index', compact('tasks'));
    }
    
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('tasks.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:30',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id'
        ]);
        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'is_completed' => $request->has('is_completed')
        ]);

        if ($request->has('tags')) {
            $task->tags()->attach($request->tags);
        }
        return redirect()->route('tasks.index');
    }

    public function show($id)
    {
        $task = Task::with(['category', 'tags'])->find($id);
        if (!$task) {
            return redirect()->route('tasks.index')->with('error', 'La tarea no existe o ya fue eliminada.');
        }
        return view('tasks.show', compact('task'));
    }

    public function edit($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return redirect()->route('tasks.index')->with('error', 'La tarea no existe o ya fue eliminada.');
        }
        $categories = Category::all();
        $tags = Tag::all();
        return view('tasks.edit', compact('task', 'categories', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return redirect()->route('tasks.index')->with('error', 'La tarea no existe o ya fue eliminada.');
        }
        $request->validate([
            'title' => 'required|max:30',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id'
        ]);
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'is_completed' => $request->has('is_completed')
        ]);

        $task->tags()->sync($request->input('tags', []));

        return redirect()->route('tasks.index');
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return redirect()->route('tasks.index')->with('error', 'La tarea ya había sido eliminada.');
        }
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
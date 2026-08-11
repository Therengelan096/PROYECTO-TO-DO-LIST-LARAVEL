<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Http\Requests\Api\TaskRequest;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['category', 'tags'])->get();

        if ($tasks->isEmpty()) {
            return response()->json([
                'message' => 'No hay registros de tareas',
                'status' => 200
            ], 200);
        }

        return response()->json([
            'tasks' => $tasks,
            'status' => 200
        ], 200);
    }

    public function store(TaskRequest $request)
    {
        $validated = $request->validated();

        $task = Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'category_id' => $validated['category_id'],
            'is_completed' => $request->boolean('is_completed')
        ]);

        if (isset($validated['tags'])) {
            $task->tags()->attach($validated['tags']);
        }

        return response()->json([
            'message' => 'Tarea creada',
            'task' => $task->load(['category', 'tags']),
            'status' => 201
        ], 201);
    }

    public function show($id)
    {
        $task = Task::with(['category', 'tags'])->find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Tarea no encontrada',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'task' => $task,
            'status' => 200
        ], 200);
    }

    public function update(TaskRequest $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Tarea no encontrada',
                'status' => 404
            ], 404);
        }

        $validated = $request->validated();

        $task->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'category_id' => $validated['category_id'],
            'is_completed' => $request->boolean('is_completed')
        ]);

        $task->tags()->sync($validated['tags'] ?? []);

        return response()->json([
            'message' => 'Tarea actualizada',
            'task' => $task->load(['category', 'tags']),
            'status' => 200
        ], 200);
    }

    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Tarea no encontrada',
                'status' => 404
            ], 404);
        }

        $task->delete();

        return response()->json([
            'message' => 'Tarea eliminada',
            'status' => 200
        ], 200);
    }
}
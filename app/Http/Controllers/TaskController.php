<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Task;

class TaskController extends Controller
{
    public function store(Request $request, Cliente $cliente)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'nullable|in:low,medium,high',
        ]);
        $cliente->tasks()->create($validated);
        return redirect()->back()->with('success', 'Tarea creada exitosamente.');
    }
    public function update(Task $task)
    {
        $task->update(['completed' => !$task->completed]); //el operador ! invierte el valor actual de completed, marcando la tarea como completada o no completada según su estado actual
        return back();

    }
}  

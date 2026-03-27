<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks()->latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(StoreTaskRequest $request)
    {
        $task = auth()->user()->tasks()->create($request->validated());
        
        // Session management demonstration
        session()->flash('success', 'Task created successfully!');
        
        return redirect()->route('tasks.index');
    }

    public function show(Task $task)
    {
        Gate::authorize('view', $task);
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        Gate::authorize('update', $task);
        return view('tasks.edit', compact('task'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        Gate::authorize('update', $task);
        $task->update($request->validated());
        
        session()->flash('success', 'Task updated successfully!');
        
        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        Gate::authorize('delete', $task);
        $task->delete();
        
        session()->flash('success', 'Task deleted successfully!');
        
        return redirect()->route('tasks.index');
    }

    public function share(Task $task)
    {
        // For signed URLs example, no auth check needed if it's explicitly shared
        return view('tasks.show', compact('task'))->with('shared', true);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $task = new Task();
        $task->title = $validated['title'];
        $task->description = $validated['description'];
        $task->user_id = auth()->id();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('task_images', 'public');
            $task->image = $imagePath;
        }

        $task->save();

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $task->title = $validated['title'];
        $task->description = $validated['description'];

        if ($request->hasFile('image')) {
            if ($task->image) {
                Storage::disk('public')->delete($task->image);
            }
            $imagePath = $request->file('image')->store('task_images', 'public');
            $task->image = $imagePath;
        }

        $task->save();

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        if ($task->image) {
            Storage::disk('public')->delete($task->image);
        }

        $task->delete();

        return redirect()->route('tasks.index');
    }
}

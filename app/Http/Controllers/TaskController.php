<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $task = new Task;
        $task->title = $request->title;
        $task->save();

        return response()->json(['success' => 'Task created successfully']);
    }

    public function edit($id)
    {
        $task = Task::find($id);
        return response()->json($task);
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $task->title = $request->title;
        $task->save();
        return response()->json(['success' => 'Task updated successfully']);
    }

    public function complete($id)
    {
        $task = Task::find($id);
        $task->completed = true;
        $task->save();
        return response()->json(['success' => 'Task completed successfully']);
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return response()->json(['success' => 'Task deleted successfully']);
    }
}

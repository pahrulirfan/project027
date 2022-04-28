<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth:api', ['except' => ['index', 'show']]);
//    }

    public function index()
    {
//        $tasks = Task::all();
        $tasks = Task::with('category')->get();

        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $task = Task::create($request->all());

        return response()->json([
            'message' => 'Great success! New task created',
            'task' => $task
        ]);
    }

    public function show($task)
    {
//        return $task;
        $tasks = Task::with('category')->where('id', $task)->first();

        return response()->json($tasks);
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
           'title'       => 'nullable',
           'description' => 'nullable'
        ]);

        $task->update($request->all());

        return response()->json([
            'message' => 'Great success! Task updated',
            'task' => $task
        ]);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json([
            'message' => 'Successfully deleted task!'
        ]);
    }
}

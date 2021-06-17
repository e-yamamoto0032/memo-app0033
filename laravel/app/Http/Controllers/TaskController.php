<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tasks = Task::all();
        return $this->jsonResponse($tasks);
    }


    public function store(TaskRequest $request)
    {
        if ($request->user_id !== Auth::id()) {
            abort(403);
        }
        $task = new Task();
        $task->fill($request->all())->save();
    }

    public function sort(Request $request)
    {
        $order = 0;
        foreach ($request->taskIds as $item) {
            $task = Task::find($item);
            $task->order = $order;
            $task->save();
            $order++;

        }
    }

    public function destroy(Request $request)
    {
        if ($request->user_id !== Auth::id()) {
            abort(403);

        }
        $task = Task::find($request->id);
        $task->delete();
    }

}

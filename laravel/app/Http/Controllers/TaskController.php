<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return $this->jsonResponse($tasks);
    }


    public function store(TaskRequest $request)
    {
        $task = new Task();
        $task->fill($request->all())->save();
    }

    public function update(TaskRequest $request, Task $task)
    {
        $task = Task::find($request->id);
        $task->fill($request->all())->save();
    }

}

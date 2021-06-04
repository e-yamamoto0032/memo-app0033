<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    public function store(TaskRequest $request)
    {
        $task = new Task();
        $task->fill($request->all())->save();
    }
}

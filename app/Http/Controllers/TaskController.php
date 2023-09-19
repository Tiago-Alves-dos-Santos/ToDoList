<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::all();
        return Inertia::render('Task/Index', [
            'tasks' => $tasks
        ]);
    }

    public function create(Request $request)
    {
        Task::create([
            'user_id' => $request->user()->id,
            'task' => $request->task
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Inertia\Inertia;
use App\Enums\TaskStatus;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Inertia\Response;

class TaskController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->task ?? '';
        $options = $request->options ?? null;
        $tasks = Task::query()->orderBy('id', 'desc');
        $column_id = $request->guard() == 'admin' ? 'admin_id' : 'user_id';
        $tasks->where($column_id, $request->user()->id);
        if (!empty($search)) {
            $tasks->where('task', 'like', "%$search%");
        }
        if (!empty($options)) {
            $options = (object) Arr::allValuesToBoolean($options);
            $tasks->filterStatusAndDelete($options);
        } else {
            $tasks->where('status', TaskStatus::PENDING);
        }
        return Inertia::render('Task/Index', [
            'tasks' => $tasks->paginate(5),
            'filter' => ['options' => $options, 'search' => $search]
        ]);
    }

    public function viewReport(): Response
    {
        return Inertia::render('Task/Report');
    }

    public function create(Request $request)
    {
        $column_id = $request->guard() == 'admin' ? 'admin_id' : 'user_id';
        $request->validate([
            'task' => ['required', 'string', 'max:100'],
        ], [], [
            'task' => "'Sua tarefa'"
        ]);
        Task::create([
            $column_id => $request->user()->id,
            'task' => $request->task
        ]);
    }
    public function update(Request $request)
    {
        Task::where('id', $request->id)->update(['task' => $request->task]);
    }
    public function toggleStatus(Request $request)
    {
        Task::where('id', $request->id)->update(['status' => $request->status]);
    }
    public function delete(Request $request)
    {
        Task::where('id', $request->id)->delete();
    }
}

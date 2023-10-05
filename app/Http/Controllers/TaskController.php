<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Inertia\Inertia;
use Inertia\Response;
use PharIo\Manifest\Url;
use App\Enums\TaskStatus;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function viewReport(Request $request): Response
    {
        $route = ($request->guard() == 'admin') ? route('task.printPDF') : null;
        return Inertia::render('Task/Report', [
            'routePrintPDF' => $route,
            'csrf' => csrf_token()
        ]);
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

    public function printPDF(Request $request)
    {
        $pdf = PDF::loadView('pdf.reportTask',[
            'name' => 'Tiago'
        ]);
        $data = json_decode($request->allData);
        dd($request->all(),$data);
        return $pdf->stream('nome.pdf');
    }
}

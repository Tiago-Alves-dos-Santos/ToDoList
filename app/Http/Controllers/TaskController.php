<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use Inertia\Inertia;
use Inertia\Response;
use App\Enums\TaskStatus;
use App\Facades\AuthServiceFacade;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public function index(Request $request): Response
    {
        $search = $request->task ?? '';
        $options = $request->options ?? null;
        $tasks = Task::query()->orderBy('id', 'desc');
        $column_id = AuthServiceFacade::getColumnIdName();

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
        $column_id = AuthServiceFacade::getColumnIdName();
        $min_date = Task::where($column_id, Auth::id())->min('created_at');
        $min_date = Carbon::parse($min_date)->format('Y-m-d');
        return Inertia::render('Task/Report', [
            'routePrintPDF' => $route,
            'csrf' => csrf_token(),
            'min_date' => $min_date
        ]);
    }

    public function create(Request $request): void
    {
        $column_id = AuthServiceFacade::getColumnIdName();
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
    public function update(Request $request): void
    {
        Task::where('id', $request->id)->update(['task' => $request->task]);
    }
    public function toggleStatus(Request $request): void
    {
        Task::where('id', $request->id)->update(['status' => $request->status]);
    }
    public function delete(Request $request): void
    {
        Task::where('id', $request->id)->delete();
    }

    public function printPDF(Request $request) : HttpResponse
    {
        $data = json_decode($request->allData);
        $column_id = AuthServiceFacade::getColumnIdName();
        $tasks = Task::query();
        $tasks->withTrashed()->where($column_id, Auth::id())
            ->whereDate('created_at', '>=', $data->dateStart)
            ->whereDate('created_at', '<=', $data->dateEnd);
        $pdf = PDF::loadView('pdf.reportTask', [
            'tasks' => $tasks->cursor(),
            'all_count_tasks' => $tasks->count(),
            'user' => Auth::user(),
        ]);

        return $pdf->stream('tasks_' . date('Y_m_d_H_i_s') . '.pdf');
    }
}

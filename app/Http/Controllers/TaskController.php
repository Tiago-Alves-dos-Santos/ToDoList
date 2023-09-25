<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use App\Models\Task;
use App\Models\User;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    public function convertObjectPropertiesToBoolean($obj) {
        // dd($obj);
        foreach ($obj as $key => $value) {
            $obj[$key] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
        }
        return $obj;
    }
    public function index(Request $request)
    {
        $search = $request->task ?? '';
        $options = $request->options ?? null;
        $tasks = Task::query()->orderBy('id','desc');
        $column_id = $request->guard() == 'admin' ? 'admin_id' : 'user_id';
        $tasks->where($column_id,$request->user()->id);
        if (!empty($search)){
            $tasks->where('task','like',"%$search%");
        }
        if(!empty($options)){
            $options = (object) $this->convertObjectPropertiesToBoolean($options);
            $tasks->filterStatusAndDelete($options);
        }else{
            $tasks->where('status',TaskStatus::PENDING);
        }
        return Inertia::render('Task/Index', [
            'tasks' => $tasks->paginate(5)
        ]);
    }

    public function create(Request $request)
    {
        $column_id = $request->guard() == 'admin' ? 'admin_id' : 'user_id';
        $request->validate([
            'task' => ['required','string','max:100'],
        ],[],[
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
    public function toggleStatus(Request $request){
        Task::where('id', $request->id)->update(['status' => $request->status]);
    }
    public function delete(Request $request)
    {
        Task::where('id', $request->id)->delete();
    }
}

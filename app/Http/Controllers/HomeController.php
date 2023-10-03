<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // dd(request()->myUser());
        $guards = config('auth.guards');
        unset($guards['sanctum']);
        foreach ($guards as $guardName => $guardConfig) {
            $user = Auth::guard($guardName)->user();
            if (!empty($user)) {
                switch ($guardName) {
                    case 'web':
                        return redirect()->route('user.dashboard');
                        break;
                    case 'admin':
                        return redirect()->route('admin.dashboard');
                        break;

                    default:
                        # code...
                        break;
                }
            }
        }
    }
    private function infoDashboard(Request $request): array
    {
        $guard = $request->guard();
        $foreing_task_column = null;
        switch ($guard) {
            case 'admin':
                $foreing_task_column = 'admin_id';
                break;
            case 'web':
                $foreing_task_column = 'user_id';
                break;
        }
        return [
            'info_card' => [
                'pending' => Task::where($foreing_task_column, Auth::id())->pending()->count(),
                'completed' => Task::where($foreing_task_column, Auth::id())->completed()->count(),
                'deleted' => Task::where($foreing_task_column, Auth::id())->onlyTrashed()->count(),
            ],
            'chart' => [

            ]
        ];
    }

    public function homeUser(Request $request): Response
    {
        $data = $this->infoDashboard($request);
        return Inertia::render('Auth/Home', $data);
    }
    public function adminHome(Request $request): Response
    {
        $data = $this->infoDashboard($request);
        return Inertia::render('Auth/Home', $data);
    }
}

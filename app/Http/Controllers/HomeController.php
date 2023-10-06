<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Facades\AuthServiceFacade;
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
        $foreing_task_column = AuthServiceFacade::getColumnIdName();

        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('Y');
        return [
            'info_card' => [
                'pending' => [
                    'name' => 'Pendentes',
                    'value' => Task::where($foreing_task_column, Auth::id())
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->pending()->count()
                ],
                'completed' => [
                    'name' => 'Completadas',
                    'value' => Task::where($foreing_task_column, Auth::id())
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->completed()->count(),
                ],
                'deleted' => [
                    'name' => 'Deletadas',
                    'value' => Task::where($foreing_task_column, Auth::id())
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->onlyTrashed()->count()
                ],
            ],
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

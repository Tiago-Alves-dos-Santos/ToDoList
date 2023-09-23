<?php

namespace App\Services;

use Illuminate\Support\Facades\Route;
// USE FACADE: PageFrontFacade
final class PageFront
{
    public function __construct(
        private string $guard,
        private array $routes = [],
    ) {
        $this->startArrayRoutes();
    }
    private function startArrayRoutes():void{
        $this->routes = [
            'comon' => [
                'task.index' => ['title' => 'Tarefas'],
                'relatorio' => ['title' => 'Relatorio'],
                'password.confirm' => ['Confirmar senha']
            ],
            'web' => [
                'user.dashboard' => ['title' => 'Dashboard'],
                'user.viewProfile' => ['title' => 'Perfil']
            ],
            'admin' => [
                'admin.dashboard' => ['title' => 'Dashboard'],
                'user.viewProfile' => ['title' => 'Perfil']
            ]

        ];
    }
    /**
     * Retorna rota atual e titulo da pagina de la tabla de datos
     *
     * @return array
     */
    public function getInfoPageAtual(): array
    {
        $route_name = Route::currentRouteName();
        $title = '';
        if(array_key_exists($route_name, $this->routes['comon'])){
            $title = $this->routes['comon'][$route_name]['title'];
        }else if(array_key_exists($route_name, $this->routes[$this->guard])){
            $title = $this->routes[$this->guard][$route_name]['title'];
        }else{
            $title = 'Não econtrado';
        }

        return [
            'title' => $title,
            'route' => $route_name
        ];
    }
    public function getLinks(): array
    {
        $comon = [
            ['label' => 'Tarefas', 'icon' => 'bi bi-list-task', 'url' => route('task.index'), 'route' => 'task.index'],
            ['label' => 'Relatorio', 'icon' => 'bi bi-filetype-pdf', 'url' => '/', 'route' => ''],
        ];
        switch ($this->guard) {
            case 'web':
                return [
                    ['label' => 'Dashboard', 'icon' => 'bi bi-speedometer2', 'url' => route('dashboard'), 'route' => 'user.dashboard'],
                    ['label' => 'Perfil', 'icon' => 'bi bi-person-gear', 'url' => route('user.viewProfile'), 'route' => 'user.viewProfile'],
                    ...$comon,
                ];
                break;
            case 'admin':
                return [
                    ['label' => 'Dashboard', 'icon' => 'bi bi-speedometer2', 'url' => route('dashboard'), 'route' => 'admin.dashboard'],
                    ['label' => 'Perfil', 'icon' => 'bi bi-person-gear', 'url' => route('admin.viewProfile'), 'route' => 'admin.viewProfile'],
                    ['label' => 'Novo admin', 'icon' => 'bi bi-person-gear', 'url' => '/', 'route' => ''],
                    ['label' => 'Usuarios', 'icon' => 'bi bi-person-gear', 'url' => '/', 'route' => ''],
                    ['label' => 'Admins', 'icon' => 'bi bi-person-gear', 'url' => '/', 'route' => ''],
                    ...$comon,
                ];
                break;

            default:
                return throw new \Exception("Guard: '{$this->guard}' não é um argumento válido");
                break;
        }
    }
}

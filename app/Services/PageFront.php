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
    public function getTitlePage(): string
    {
        $routeName = Route::currentRouteName();
        $title = '';
        if(array_key_exists($routeName, $this->routes['comon'])){
            $title = $this->routes['comon'][$routeName]['title'];
        }else if(array_key_exists($routeName, $this->routes[$this->guard])){
            $title = $this->routes[$this->guard][$routeName]['title'];
        }else{
            $title = 'Não econtrado';
        }

        return $title;
    }
    public function getLinks(): array
    {
        $comon = [
            ['label' => 'Dashboard', 'icon' => 'bi bi-speedometer2', 'url' => route('dashboard')],
            ['label' => 'Tarefas', 'icon' => 'bi bi-list-task', 'url' => route('task.index')],
            ['label' => 'Relatorio', 'icon' => 'bi bi-filetype-pdf', 'url' => '/'],
        ];
        switch ($this->guard) {
            case 'web':
                return [
                    ...$comon,
                    ['label' => 'Perfil', 'icon' => 'bi bi-person-gear', 'url' => route('user.viewProfile')],
                ];
                break;
            case 'admin':
                return [
                    ...$comon,
                    ['label' => 'Perfil', 'icon' => 'bi bi-person-gear', 'url' => route('admin.viewProfile')],
                    ['label' => 'Novo admin', 'icon' => 'bi bi-person-gear', 'url' => '/'],
                    ['label' => 'Usuarios', 'icon' => 'bi bi-person-gear', 'url' => '/'],
                    ['label' => 'Admins', 'icon' => 'bi bi-person-gear', 'url' => '/'],
                ];
                break;

            default:
                return throw new \Exception("Guard: '{$this->guard}' não é um argumento válido");
                break;
        }
    }
}

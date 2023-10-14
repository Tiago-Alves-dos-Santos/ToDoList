<?php

namespace App\Services;

use Illuminate\Support\Facades\Route;
// USE FACADE: PageFrontFacade
final class PageFront
{
    public function __construct(
        private string $guard,
        private array $routes = [], //rotas acessadas pelo menu sidebar, saber titulo da pagina
    ) {
        $this->startArrayRoutes();
    }
    /**
     * Popular o array de routes
     *
     * @return void
     */
    private function startArrayRoutes(): void
    {
        $this->routes = [
            'comon' => [
                'task.index' => ['title' => 'Tarefas'],
                'relatorio' => ['title' => 'Relatorio'],
                'password.confirm' => ['title' => 'Confirmar senha'],
                'task.viewReport' => ['title' => 'PDF'],
            ],
            'web' => [
                'user.dashboard' => ['title' => 'Dashboard'],
                'user.viewProfile' => ['title' => 'Perfil']
            ],
            'admin' => [
                'admin.dashboard' => ['title' => 'Dashboard'],
                'admin.viewProfile' => ['title' => 'Perfil'],
                'admin.viewRegister' => ['title' => 'Novo Admin'],
                'admin.viewListUsers' => ['title' => 'Lista de usuários'],
                'admin.viewAdmins' => ['title' => 'Lista de administradores'],
            ]

        ];
    }
    /**
     * Retorna rota atual e titulo da pagina atual pelo array de rotas
     *
     * @return array
     */
    public function getInfoPageActual(): array
    {
        if (!empty($this->guard)) {
            $route_name = Route::currentRouteName();
            $title = '';
            if (array_key_exists($route_name, $this->routes['comon'])) { //verfica em rotas comuns
                $title = $this->routes['comon'][$route_name]['title'];
            } else if (array_key_exists($route_name, $this->routes[$this->guard])) { //verfica nas rotas baseada no guard
                $title = $this->routes[$this->guard][$route_name]['title'];
            } else { //rota não encontrada, retorna o titulo
                $title = 'Não encontrado';
            }

            return [
                'title' => $title,
                'route' => $route_name
            ];
        }
    }
    /**
     * Popular menu sidebar com os links, baseados no guard
     *
     * @return array
     */
    public function getLinks(): array
    {
        $comon = [
            ['label' => 'Tarefas', 'icon' => 'bi bi-list-task', 'url' => route('task.index'), 'route' => 'task.index'],
            ['label' => 'Relatorio', 'icon' => 'bi bi-filetype-pdf', 'url' => route('task.viewReport'), 'route' => 'task.viewReport'],
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
                    ['label' => 'Novo admin', 'icon' => 'bi bi-person-plus-fill', 'url' => route('admin.viewRegister'),  'route' => 'admin.viewRegister'],
                    ['label' => 'Usuarios', 'icon' => 'bi bi-person-lines-fill', 'url' => route('admin.viewListUsers'), 'route' => 'admin.viewListUsers'],
                    ['label' => 'Admins', 'icon' => 'bi bi-person-lines-fill', 'url' => route('admin.viewAdmins'), 'route' => 'admin.viewAdmins'],
                    ...$comon,
                ];
                break;

            default: //null
                return [];
                break;
        }
    }
}

<?php
namespace App\Services;
final class Sidebar
{
    public function __construct(
        private string $guard,
    ) {}
    public function getLinks(): array
    {
        $comon = [
            ['label' => 'Dashboard','icon' => 'bi bi-speedometer2', 'url' => route('dashboard')],
            ['label' => 'Tarefas','icon' => 'bi bi-list-task', 'url' => route('task.index')],
            ['label' => 'Relatorio','icon' => 'bi bi-filetype-pdf', 'url' => '/'],
        ];
        switch ($this->guard) {
            case 'web':
                return [
                    ...$comon,
                    ['label' => 'Perfil','icon' => 'bi bi-person-gear', 'url' => route('user.viewProfile')],
                ];
                break;
            case 'admin':
                return [
                    ...$comon,
                    ['label' => 'Perfil','icon' => 'bi bi-person-gear', 'url' => route('admin.viewProfile')],
                    ['label' => 'Novo admin','icon' => 'bi bi-person-gear', 'url' => '/'],
                    ['label' => 'Usuarios','icon' => 'bi bi-person-gear', 'url' => '/'],
                    ['label' => 'Admins','icon' => 'bi bi-person-gear', 'url' => '/'],
                ];
                break;

            default:
                return throw new \Exception("Guard: '{$this->guard}' não é um argumento válido");
                break;
        }
    }
}

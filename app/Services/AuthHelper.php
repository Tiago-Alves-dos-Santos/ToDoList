<?php
namespace App\Services;
use App\Enums\Guard;
final class AuthService
{
    private array $guards = [];
    public function __construct(
        private string $guard = ''
    )
    {
        $this->startArrayGuards();
    }
    private function startArrayGuards():void{
        $reflectionClass = new \ReflectionClass(Guard::class);
        $this->guards = $reflectionClass->getConstants();
    }
    public function getColumnIdName():string
    {
        return $this->guards[strtoupper($this->guard)]->value;
    }
}

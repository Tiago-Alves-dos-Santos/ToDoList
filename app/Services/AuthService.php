<?php
namespace App\Services;
use App\Enums\Guard;
final class AuthService
{
    //arrays com guards existentes
    private array $guards = [];

    public function __construct(
        private string $guard = ''
    )
    {
        $this->startArrayGuards();
    }
    /**
     * Setar dados de guard no array, guard listados pelo ENUM - GUARD
     *
     * @return void
     */
    private function startArrayGuards():void{
        $reflectionClass = new \ReflectionClass(Guard::class);
        $this->guards = $reflectionClass->getConstants();
    }
    /**
     * Retorna a coluna 'id' como foreng_key exemplo 'guard_id'
     *
     * @return string
     */
    public function getColumnIdName():string
    {
        if($this->guard == Guard::WEB->value){
            return 'user_id';
        }
        return $this->guards[strtoupper($this->guard)]->value.'_id';
    }
}

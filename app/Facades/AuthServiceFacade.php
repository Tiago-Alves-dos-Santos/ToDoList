<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

final class AuthServiceFacade extends Facade
{
    protected static function getFacadeAccessor(){
        return 'AuthService';
    }

}

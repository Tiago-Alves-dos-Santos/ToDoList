<?php
namespace App\Facades;

use App\Services\FortifyCustom;
use Illuminate\Support\Facades\Facade;

final class FortifyFacade extends Facade
{
    protected static function getFacadeAccessor(){
        return FortifyCustom::class;
    }

}

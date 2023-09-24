<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

final class PageFrontFacade extends Facade
{
    protected static function getFacadeAccessor(){
        return 'PageFront';
    }
}

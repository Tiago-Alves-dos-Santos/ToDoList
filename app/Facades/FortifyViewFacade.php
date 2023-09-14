<?php
namespace App\Facades;

use App\Services\FortifyView;
use Illuminate\Support\Facades\Facade;

final class FortifyViewFacade extends Facade
{
    protected static function getFacadeAccessor(){
        return FortifyView::class;
    }

}

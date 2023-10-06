<?php
namespace App\Enums;
enum Guard: string
{
    case ADMIN = 'admin';
    case USER = 'web';
}

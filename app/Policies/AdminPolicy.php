<?php

namespace App\Policies;

use App\Enums\TypeAdmin;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;
    private $admin = null;
    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->admin = Auth::guard('admin')->user();
    }

    public function listAllAdmins(Admin $admin){
        return $this->admin->type == TypeAdmin::MASTER->value ? true:false;
    }
}

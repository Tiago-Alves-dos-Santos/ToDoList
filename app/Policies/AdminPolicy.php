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

    /**
     * Caso admin igual a master ou admin cadastrou usuario a ser deletado ele pode deletar
     *
     * @param Admin $admin
     * @return boolean
     */
    public function deleteThe(Admin $admin):bool
    {
        if($this->admin->type == TypeAdmin::MASTER->value || $this->admin->id = $admin->admin_creator_id){
            return true;
        }else{
            return false;
        }
    }
}

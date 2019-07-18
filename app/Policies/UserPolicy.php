<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Auth;
use Session;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the given user can view vartotojai.
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function view(User $user)
    {
        if(!$user->permissions->where('permission_id', env('P_ADMIN'))->isEmpty()){
            return true;
        } 
        
        return false;
    }

    
}

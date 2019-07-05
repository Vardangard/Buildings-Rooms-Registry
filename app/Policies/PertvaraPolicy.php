<?php

namespace App\Policies;

use App\User;
use App\Pertvara;
use Illuminate\Auth\Access\HandlesAuthorization;

class PertvaraPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any pertvaras.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the pertvara.
     *
     * @param  \App\User  $user
     * @param  \App\Pertvara  $pertvara
     * @return mixed
     */
    public function view(User $user, Pertvara $pertvara)
    {
        //
    }

    /**
     * Determine whether the user can create pertvaras.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if(!$user->permissions->where('permission_id', 71)->isEmpty()){
            return true;
        } 
        return false;
    }

    public function elements(User $user)
    {
        if(!$user->permissions->where('permission_id', 71)->isEmpty() || !$user->permissions->where('permission_id', env("P_REGULAR"))->isEmpty()){
            return true;
        } 
        return false;
    }


    /**
     * Determine whether the user can update the pertvara.
     *
     * @param  \App\User  $user
     * @param  \App\Pertvara  $pertvara
     * @return mixed
     */
    public function update(User $user, Pertvara $pertvara)
    {
        if(!$user->permissions->where('permission_id', 71)->isEmpty() || !$user->permissions->where('permission_id', env("P_REGULAR"))->isEmpty()){
            return true;
        } 
        return false;
    }

    /**
     * Determine whether the user can delete the pertvara.
     *
     * @param  \App\User  $user
     * @param  \App\Pertvara  $pertvara
     * @return mixed
     */
    public function delete(User $user, Pertvara $pertvara)
    {
        if(!$user->permissions->where('permission_id', 71)->isEmpty()){
            return true;
        } 
        return false;
    }

    /**
     * Determine whether the user can restore the pertvara.
     *
     * @param  \App\User  $user
     * @param  \App\Pertvara  $pertvara
     * @return mixed
     */
    public function restore(User $user, Pertvara $pertvara)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the pertvara.
     *
     * @param  \App\User  $user
     * @param  \App\Pertvara  $pertvara
     * @return mixed
     */
    public function forceDelete(User $user, Pertvara $pertvara)
    {
        //
    }
}

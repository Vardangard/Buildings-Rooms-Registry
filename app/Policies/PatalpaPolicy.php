<?php

namespace App\Policies;

use App\User;
use App\Patalpa;
use Illuminate\Auth\Access\HandlesAuthorization;
use Auth;

class PatalpaPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any patalpas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if(!$user->permissions->where('permission_id', env('P_ADMIN'))->isEmpty() || !$user->permissions->where('permission_id', env("P_REGULAR"))->isEmpty()){
            return true;
        } 
        return false;
    }

    /**
     * Determine whether the user can view the patalpa.
     *
     * @param  \App\User  $user
     * @param  \App\Patalpa  $patalpa
     * @return mixed
     */
    public function view(User $user, Patalpa $patalpa)
    {
        //
    }

    /**
     * Determine whether the user can create patalpas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if(!$user->permissions->where('permission_id',  env('P_ADMIN'))->isEmpty()){
            return true;
        } 
        return false;
    }

    public function elements(User $user)
    {
        if(!$user->permissions->where('permission_id', env('P_ADMIN'))->isEmpty() || !$user->permissions->where('permission_id', env("P_REGULAR"))->isEmpty()){
            return true;
        } 
        return false;
    }

    /**
     * Determine whether the user can update the patalpa.
     *
     * @param  \App\User  $user
     * @param  \App\Patalpa  $patalpa
     * @return mixed
     */
    public function update(User $user, Patalpa $patalpa)
    {
        if(!$user->permissions->where('permission_id', env('P_ADMIN'))->isEmpty() || !$user->permissions->where('permission_id', env("P_REGULAR"))->isEmpty()){
            if(in_array($patalpa->pastatai_id, Auth::user()->pastatai->pluck('id')->toArray()) || !$user->permissions->where('permission_id', env('P_ADMIN'))->isEmpty())
                return true;
        } 
        return false;
    }

    /**
     * Determine whether the user can delete the patalpa.
     *
     * @param  \App\User  $user
     * @param  \App\Patalpa  $patalpa
     * @return mixed
     */
    public function delete(User $user, Patalpa $patalpa)
    {
        if(!$user->permissions->where('permission_id', env('P_ADMIN'))->isEmpty()){
            return true;
        } 
        return false;
    }

    /**
     * Determine whether the user can restore the patalpa.
     *
     * @param  \App\User  $user
     * @param  \App\Patalpa  $patalpa
     * @return mixed
     */
    public function restore(User $user, Patalpa $patalpa)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the patalpa.
     *
     * @param  \App\User  $user
     * @param  \App\Patalpa  $patalpa
     * @return mixed
     */
    public function forceDelete(User $user, Patalpa $patalpa)
    {
        //
    }
}

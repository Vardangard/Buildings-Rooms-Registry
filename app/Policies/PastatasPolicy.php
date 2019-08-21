<?php

namespace App\Policies;

use App\User;
use App\Pastatas;
use Illuminate\Auth\Access\HandlesAuthorization;
use Auth;

class PastatasPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any pastatas.
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
     * Determine whether the user can view the pastatas.
     *
     * @param  \App\User  $user
     * @param  \App\Pastatas  $pastatas
     * @return mixed
     */
    public function view(User $user, Pastatas $pastatas)
    {
        //
    }

    /**
     * Determine whether the user can create pastatas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if(!$user->permissions->where('permission_id', env('P_ADMIN'))->isEmpty()){
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
     * Determine whether the user can update the pastatas.
     *
     * @param  \App\User  $user
     * @param  \App\Pastatas  $pastatas
     * @return mixed
     */
    public function update(User $user, Pastatas $pastatas)
    {
        if(!$user->permissions->where('permission_id', env('P_ADMIN'))->isEmpty() || !$user->permissions->where('permission_id', env("P_REGULAR"))->isEmpty()){
            if(in_array($pastatas->id, Auth::user()->pastatai->pluck('id')->toArray()) || !$user->permissions->where('permission_id', env('P_ADMIN'))->isEmpty())
            //if(!$user->permissions->where('permission_id', env('P_ADMIN'))->isEmpty())
                return true;
        } 
        return false;
    }

    /**
     * Determine whether the user can delete the pastatas.
     *
     * @param  \App\User  $user
     * @param  \App\Pastatas  $pastatas
     * @return mixed
     */
    public function delete(User $user, Pastatas $pastatas)
    {
        if(!$user->permissions->where('permission_id', env('P_ADMIN'))->isEmpty()){
            return true;
        } 
        return false;
    }

    /**
     * Determine whether the user can restore the pastatas.
     *
     * @param  \App\User  $user
     * @param  \App\Pastatas  $pastatas
     * @return mixed
     */
    public function restore(User $user, Pastatas $pastatas)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the pastatas.
     *
     * @param  \App\User  $user
     * @param  \App\Pastatas  $pastatas
     * @return mixed
     */
    public function forceDelete(User $user, Pastatas $pastatas)
    {
        //
    }
}

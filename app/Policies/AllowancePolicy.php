<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use App\Models\Allowance;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class AllowancePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return in_array($user->role_id, [Role::Admin, Role::Manager, Role::Accountant]) ? Response::allow() : Response::denyAsNotFound();  
        
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Allowance  $allowance
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Allowance $allowance)
    {
        return in_array($user->role_id, [Role::Admin, Role::Accountant]) ? Response::allow() : Response::denyAsNotFound(); 
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->role_id == Role::Accountant ? Response::allow() : Response::denyAsNotFound();  
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Allowance  $allowance
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Allowance $allowance)
    {
        return $user->role_id == Role::Accountant ? Response::allow() : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Allowance  $allowance
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Allowance $allowance)
    {        
        return $user->role_id == Role::Accountant ? Response::allow() : Response::denyAsNotFound();  
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Allowance  $allowance
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Allowance $allowance)
    {
        return $user->role_id == Role::Accountant ? Response::allow() : Response::denyAsNotFound();    
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Allowance  $allowance
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Allowance $allowance)
    {
        return $user->role_id == Role::Accountant ? Response::allow() : Response::denyAsNotFound();   

    }
}

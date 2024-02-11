<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        return $user->role_id = 1 ? Response::allow() : Response::denyAsNotFound();
    }

 
    public function view(User $user)
    {
        return $user->role_id == 1 ? Response::allow() : Response::denyAsNotFound();
        
    }


    public function create(User $user)
    {
        return $user->role_id === 1 ? Response::allow() : Response::denyAsNotFound();
    }
    

    public function update(User $user)
    {
        return $user->role_id === 1 ? Response::allow() : Response::denyAsNotFound();
        
    }

    public function delete(User $user)
    {
        return $user->role_id === 1 ? Response::allow() : Response::denyAsNotFound();
    }


    public function restore(User $user)
    {
        //
    }


    public function forceDelete(User $user)
    {
        //
    }
}

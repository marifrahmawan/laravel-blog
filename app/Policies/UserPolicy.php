<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

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

    public function create_admin(User $user){
        return $user->hasRole('super-admin');
    }

    public function delete_admin(User $user){
        return $user->hasRole('super-admin');
    }
}

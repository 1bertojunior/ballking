<?php

namespace App\Policies;

use App\Models\Team;
use App\Models\User;
use App\RoleEnum;
use Illuminate\Auth\Access\Response;

class TeamPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role_id, [RoleEnum::ADMIN, RoleEnum::USER]);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Team $team): bool
    {
        return in_array($user->role_id, [RoleEnum::ADMIN, RoleEnum::USER]);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role_id == RoleEnum::ADMIN;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Team $team): bool
    {
        return $user->role_id == RoleEnum::ADMIN;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Team $team): bool
    {
        return $user->role_id == RoleEnum::ADMIN;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Team $team): bool
    {
        return $user->role_id == RoleEnum::ADMIN;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Team $team): bool
    {
        return $user->role_id == RoleEnum::ADMIN;
    }
}

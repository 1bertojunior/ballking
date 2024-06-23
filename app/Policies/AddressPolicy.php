<?php

namespace App\Policies;

use App\Models\Address;
use App\Models\User;
use App\RoleEnum;
use Illuminate\Auth\Access\Response;

class AddressPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role_id == RoleEnum::ADMIN;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Address $address): bool
    {
        return in_array($user->role_id, [RoleEnum::ADMIN, RoleEnum::USER]);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array($user->role_id, [RoleEnum::ADMIN, RoleEnum::USER]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Address $address): bool
    {
        return in_array($user->role_id, [RoleEnum::ADMIN, RoleEnum::USER]);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Address $address): bool
    {
        return $user->role_id == RoleEnum::ADMIN;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Address $address): bool
    {
        return $user->role_id == RoleEnum::ADMIN;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Address $address): bool
    {
        return $user->role_id == RoleEnum::ADMIN;
    }
}

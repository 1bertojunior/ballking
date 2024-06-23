<?php

namespace App\Policies;

use App\Models\ChampionshipEdition;
use App\Models\User;
use App\RoleEnum;
use Illuminate\Auth\Access\Response;

class ChampionshipEditionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role_id, [RoleEnum::ADMIN, RoleEnum::USER]);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ChampionshipEdition $championshipEdition): bool
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
    public function update(User $user, ChampionshipEdition $championshipEdition): bool
    {
        return $user->role_id == RoleEnum::ADMIN;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ChampionshipEdition $championshipEdition): bool
    {
        return $user->role_id == RoleEnum::ADMIN;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ChampionshipEdition $championshipEdition): bool
    {
        return $user->role_id == RoleEnum::ADMIN;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ChampionshipEdition $championshipEdition): bool
    {
        return $user->role_id == RoleEnum::ADMIN;
    }
}

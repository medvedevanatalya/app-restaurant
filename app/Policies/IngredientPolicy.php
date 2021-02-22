<?php

namespace App\Policies;

use App\Models\Ingredient;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class IngredientPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ingredient  $ingredient
     * @return mixed
     */
    public function view(User $user, Ingredient $ingredient)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if($user->role === "administrator")
            return true;

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ingredient  $ingredient
     * @return mixed
     */
    public function update(User $user, Ingredient $ingredient)
    {
        if($user->role === "administrator")
            return true;

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ingredient  $ingredient
     * @return mixed
     */
    public function delete(User $user, Ingredient $ingredient)
    {
        if($user->role === "administrator")
            return true;

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ingredient  $ingredient
     * @return mixed
     */
    public function restore(User $user, Ingredient $ingredient)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ingredient  $ingredient
     * @return mixed
     */
    public function forceDelete(User $user, Ingredient $ingredient)
    {
        //
    }
}

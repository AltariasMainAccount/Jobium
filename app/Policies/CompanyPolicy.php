<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization;

    /* Was intended to be used, ended up not getting used due to problems with the policies getting slower no matter if I checked using foreach or using in_array
    *    private function isPartOfCompany(User $user, Company $company) {
    *        $array = unserialize($company->users);
    *        $found = false;
    *
    *        foreach ($array as &$value) {
    *            if ($value == $user->id) {
    *                $found = true;
    *            };
    *        }
    *
    *        return $found;
    *    }
    */
    

    public function before(User $user) {
        if ($user->tokenCan('admin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user) {
        return ($user->tokenCan('company:view') || $user->tokenCan('company:update') || $user->tokenCan('company:create') || $user->tokenCan('company:all'));
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Company $company) {
        return ($user->tokenCan('company:view') || $user->tokenCan('company:update') || $user->tokenCan('company:create') || $user->tokenCan('company:all'));
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user) {
        return ($user->tokenCan('company:create') || $user->tokenCan('company:all'));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Company $company) {
        return ($user->tokenCan('company:update') || $user->tokenCan('company:create') || $user->tokenCan('company:all'));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Company $company) {
        return $user->tokenCan('company:all');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Company $company) {
        return $user->tokenCan('company:all');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Company $company) {
        return $user->tokenCan('company:all');
    }
}

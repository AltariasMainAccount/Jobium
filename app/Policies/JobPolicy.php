<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobPolicy
{
    use HandlesAuthorization;
    
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
        return ($user->tokenCan('job:view') || $user->tokenCan('job:update') || $user->tokenCan('job:create') || $user->tokenCan('job:all'));
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Job $job) {
        return ($user->tokenCan('job:view') || $user->tokenCan('job:update') || $user->tokenCan('job:create') || $user->tokenCan('job:all'));
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user) {
        return ($user->tokenCan('job:create') || $user->tokenCan('job:all'));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Job $job) {
        return ($user->tokenCan('job:update') || $user->tokenCan('job:create') || $user->tokenCan('job:all'));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Job $job) {
        return $user->tokenCan('job:all');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Job $job) {
        return $user->tokenCan('job:all');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Job $job) {
        return $user->tokenCan('job:all');
    }
}

<?php

namespace App\Providers;

// Models and Policies

use App\Models\User;
use App\Policies\UserPolicy;
use App\Models\Company;
use App\Policies\CompanyPolicy;
use App\Models\Job;
use App\Policies\JobPolicy;

// Auth Services
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Job::class => JobPolicy::class,
        Company::class => CompanyPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}

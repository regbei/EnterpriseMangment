<?php

namespace App\Providers;

use App\Models\User;
use App\Models\AccountInfo;
use App\Policies\UserPolicy;
use App\Models\CompanyAccount;
use App\Policies\AccountPolicy;
use App\Policies\CompanyPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        CompanyAccount::class => CompanyPolicy::class,
        AccountInfo::class => AccountPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}

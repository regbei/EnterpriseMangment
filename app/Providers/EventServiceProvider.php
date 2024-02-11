<?php

namespace App\Providers;

use App\Events\PayrollExpirey;
use App\Events\AllowanceExpirey;
use App\Events\DeductionExpirey;
use App\Listeners\RemoveAllowance;
use App\Listeners\RemoveDeduction;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\DeleteExpiredPayrolls; 
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        PayrollExpirey::class =>[
            DeleteExpiredPayrolls::class,
        ],
        AllowanceExpirey::class=>[
            RemoveAllowance::class,
        ],
        DeductionExpirey::class => [
            RemoveDeduction::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}

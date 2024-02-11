<?php

namespace App\Providers;

use App\Providers\PayrollExpired;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeleteExpiredPayrolls
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Providers\PayrollExpired  $event
     * @return void
     */
    public function handle(PayrollExpired $event)
    {
        //
    }
}

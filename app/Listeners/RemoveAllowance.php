<?php

namespace App\Listeners;

use App\Models\Allowance;
use App\Events\AllowanceExpirey;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RemoveAllowance
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
     * @param  \App\Events\AllowanceExpirey  $event
     * @return void
     */
    public function handle(AllowanceExpirey $event)
    {
        Allowance::whereIn('endDate', [Date('Y-m-d')])->delete();
    }
}

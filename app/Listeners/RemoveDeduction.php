<?php

namespace App\Listeners;

use App\Models\Deduction;
use App\Events\DeductionExpirey;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RemoveDeduction
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
     * @param  \App\Events\DeductionExpirey  $event
     * @return void
     */
    public function handle(DeductionExpirey $event)
    {
        Deduction::whereIn('endDate', [Date('Y-m-d')])->delete();

    }
}

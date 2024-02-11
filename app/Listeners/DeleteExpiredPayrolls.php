<?php

namespace App\Listeners;

use App\Models\Payroll;
use App\Events\PayrollExpirey;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteExpiredPayrolls
{

    public function __construct()
    {
        //
    }

   
    public function handle(PayrollExpirey $event)
    {
        Payroll::whereIn('endDate', [Date('Y-m-d')])->delete();
    }
}

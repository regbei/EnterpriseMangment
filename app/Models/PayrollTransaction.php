<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollTransaction extends Model
{
    use HasFactory;
    protected $fillable = ['payroll_id','company_account_acc_number', 'amount', 'date'];

    public $timestamps = false;

    public function payroll()
    {
        return $this->belongsTo(Payroll::class);
    }

    public function companyAccounts()
    {
        return $this->belongsTo(CompanyAccount::class,  'acc_number','company_account_acc_number');
    }


}

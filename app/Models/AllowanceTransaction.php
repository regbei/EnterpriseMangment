<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllowanceTransaction extends Model
{
    use HasFactory;
    protected $fillable = ['allowance_id','company_account_acc_number', 'amount', 'date'];

    public $timestamps = false;


    public function allowance()
    {
        return $this->belongsTo(Allowance::class);
    }

    public function companyAccounts()
    {
        return $this->belongsTo(CompanyAccount::class,  'acc_number','company_account_acc_number');
    }


}

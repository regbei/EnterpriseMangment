<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyAccount extends Model
{
    use HasFactory;
    protected $fillable = ['acc_number', 'balance', 'name','employee_id'];

    protected $primaryKey = "acc_number";
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // public function AccountNumber()
    // {
    //     return $this->hasOne(AccountInfo::class);
        
    // }


    public function payrollTransactions()
    {
        return $this->hasMany(PayrollTransaction::class, 'company_account_acc_number','acc_number');
        
    }

    public function allowanceTransactions()
    {
        return $this->hasMany(AllowanceTransaction::class,'company_account_acc_number','acc_number');
        
    }

    public function deductionTransactions()
    {
        return $this->hasMany(DeductionTransaction::class,'company_account_acc_number','acc_number');
        
    }

    public function bankTransactions()
    {
        return $this->hasMany(BankTransaction::class,'acc_number', 'company_account_acc_number');
    }
}

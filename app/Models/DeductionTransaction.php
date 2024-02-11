<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeductionTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['deduction_id','company_account_acc_number', 'amount', 'date'];
    // protected $primaryKey = "id";
    public $timestamps = false;


    public function deduction()
    {
        return $this->belongsTo(Deduction::class, 'deduction_id', 'id');
    }

    // public function employee()
    // {
    //     return $this->belongsTo(Employee::class, Deduction::class,  'employee_id', 'id');
    // }

    public function deductionTypes()
    {
        return $this->hasManyThrough(DeductionType::class, Deduction::class);
    }

    public function companyAccounts()
    {
        return $this->belongsTo(CompanyAccount::class,  'acc_number','company_account_acc_number');
        
    }

    

}

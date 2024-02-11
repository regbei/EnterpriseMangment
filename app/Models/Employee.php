<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'firstName', 'sureName', 'thirdName', 'lastName', 'gender', 'religion','marital_status', 'status','birthDate'
    ,'hiredAt', 'phone', 'email', 'position', 'qualifications', 'department_id', 'branch_id', 'address', 'image'];


    public function payroll()
    {
        return $this->hasOne(Payroll::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    
    public function deductions()
    {
        return $this->hasMany(Deduction::class);
    }
    
    public function allowances()
    {
        return $this->hasMany(Allowance::class);
    }

    public function deductionTypes()
    {
        return $this->hasManyThrough(DeductionType::class, Deduction::class);
    }
    
    public function allowanceTypes()
    {
        return $this->hasManyThrough(AllowanceType::class, Allowance::class);
    }
 
    public function payrollTransactions()
    {
        return $this->hasManyThrough(PayrollTransaction::class, Payroll::class, 'employee_id', 'id');
    }
 
    public function allowanceTransactions()
    {
        return $this->hasManyThrough(AllowanceTransaction::class, Allowance::class, 'employee_id', 'id');
    }
 
    public function deductionTransactions()
    {
        return $this->hasManyThrough(DeductionTransaction::class, Deduction::class, 'employee_id', 'deduction_id');
    }


    public function companyAccounts()
    {
        return $this->hasMany(CompanyAccount::class);
    }

}

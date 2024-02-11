<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'salary', 'effectiveDate', 'endDate'];

    // public $timestamps = false;

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
    public function transactions()
    {
        return $this->hasMany(PayrollTransaction::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deduction extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'deduction_type_id', 'amount', 'stmt', 'effectiveDate', 'endDate'];

    // protected $primaryKey = "id";
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function deductionTypes()
    {
        return $this->hasMany(DeductionType::class, 'id','deduction_type_id');
    }

    public function transactions()
    {
        return $this->hasMany(DeductionTransaction::class, 'id', 'deduction_id');
    }
}

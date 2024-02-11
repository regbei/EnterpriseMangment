<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Allowance extends Model
{
    use HasFactory;
    
    protected $fillable = ['employee_id', 'allowance_type_id', 'amount', 'stmt', 'effectiveDate', 'endDate'];

    protected $primaryKey = "id";

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function allowanceTypes()
    {
        return $this->hasMany(AllowanceType::class, 'id', 'allowance_type_id');
    }

    public function transactions()
    {
        return $this->hasMany(AllowanceTransaction::class);
    }
}

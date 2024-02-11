<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AllowanceType extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    public function allowances()
    {
        return $this->belongsTo(Allowance::class, 'allowance_type_id', 'id');
    }

    // public function employee()
    // {
    //     return $this->belongsTo(Employee::class, Allowance::class);
    // }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['id','name', 'employee_id'];



    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    
    public function departmentManager()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
    
}

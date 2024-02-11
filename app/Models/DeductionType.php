<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeductionType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];
    protected $primaryKey = "id";

    public function deduction(){

        return $this->belongsTo(Deduction::class, 'deduction_type_id', 'id');
        
    }

    public function employees(){

        return $this->hasManyThrough(Employee::class, Deduction::class, 'deduction_type_id', 'id');
        
    }
}

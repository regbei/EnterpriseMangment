<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['Fname', 'title', 'type','method','description','amount','amount_paid', 'residual', 'expense_id', 'status'];

    public function expenseType()
    {
        return $this->hasMany(ExpenseType::class);
    }
    
}

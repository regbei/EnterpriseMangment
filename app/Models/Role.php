<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    
    Public Const Admin = 1;
    Public Const Manager = 2;
    Public Const Accountant = 3;
    Public Const Guest = 4;

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}

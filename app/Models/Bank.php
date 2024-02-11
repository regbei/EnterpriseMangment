<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'swiftKey', 'branch'];


    public function bankTransaction()
    {
        return $this->hasMany(BankTransaction::class);
    }

    public function accounts()
    {
        return $this->hasMany(AccountInfo::class);
    }

}

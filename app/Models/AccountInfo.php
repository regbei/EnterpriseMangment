<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountInfo extends Model
{
    use HasFactory;

    protected $fillable = ['acc_number', 'owner_name', 'phone', 'email'];

    protected $primaryKey = "acc_number";

    public function bankTransactions()
    {
        return $this->hasMany(BankTransaction::class, 'account_info_id', 'acc_number');
    }
}

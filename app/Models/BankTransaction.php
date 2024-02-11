<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['account_info_acc_number', 'company_account_acc_number','amount', 'title', 'statment', 'bank_id', 'user_id'];
    
    
    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
    

    public function companyAccounts()
    {
        return $this->belongsTo(CompanyAccounts::class, 'company_account_acc_number', 'acc_number');
    }
    
    public function accounts()
    {
        return $this->belongsTo(AccountInfo::class, 'account_info_acc_number', 'acc_number');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}

<?php

use App\Models\Bank;
use App\Models\User;
use App\Models\AccountInfo;
use App\Models\CompanyAccount;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AccountInfo::class);
            $table->foreignIdFor(CompanyAccount::class);
            $table->unsignedBigInteger('amount');
            $table->text('title');
            $table->foreignIdFor(Bank::class);
            $table->foreignIdFor(User::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_transactions');
    }
};

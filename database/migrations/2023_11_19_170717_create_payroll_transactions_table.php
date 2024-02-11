<?php

use App\Models\Payroll;
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
        Schema::create('payroll_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Payroll::class);
            $table->foreignIdFor(CompanyAccount::class);
            $table->unsignedBigInteger('amount');
            $table->Date('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payroll_transactions');
    }
};

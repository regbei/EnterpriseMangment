<?php

use App\Models\Deduction;
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
        Schema::create('deduction_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Deduction::class);
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
        Schema::dropIfExists('deduction_transactions');
    }
};

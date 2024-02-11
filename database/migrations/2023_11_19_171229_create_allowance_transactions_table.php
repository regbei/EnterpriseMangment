<?php

use App\Models\Allowance;
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
        Schema::create('allowance_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Allowance::class);
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
        Schema::dropIfExists('allowance_transactions');
    }
};

<?php

use App\Models\ExpenseCategory;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('Fname');
            $table->string('title');
            $table->string('type');
            $table->string('method');
            $table->longText('description');
            $table->bigInteger('amount');
            $table->bigInteger('amount_paid');
            $table->bigInteger('residual');
            $table->foreignIdFor(ExpenseCategory::class);
            $table->enum('status',['paid', 'unpaid']);
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
        Schema::dropIfExists('payments');
    }
};

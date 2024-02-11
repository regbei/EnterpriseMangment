<?php

use App\Models\Employee;
use App\Models\AllowanceType;
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
        Schema::create('allowances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignIdFor(Employee::class);
            $table->foreignIdFor(AllowanceType::class);
            $table->integer('amount');
            $table->longText('stmt');
            $table->date('effectiveDate');
            $table->date('endDate');
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
        Schema::dropIfExists('allowances');
    }
};

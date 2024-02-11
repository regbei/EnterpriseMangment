<?php

use App\Models\Employee;
use App\Models\DeductionType;
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
        Schema::create('deductions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignIdFor(Employee::class);
            $table->foreignIdFor(DeductionType::class);
            $table->integer('amount');
            $table->longText('stmt');
            $table->date('effectiveDate');
            $table->date('endDate');
            $table->timestamps();
            $table->index('employee_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deductions');
    }
};

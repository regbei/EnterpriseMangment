<?php

use App\Models\Branch;
use App\Models\Department;
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
        Schema::create('employees', function (Blueprint $table) {
            $table->unsignedBigInteger('id', 22);
            $table->mediumText('firstName', 12);
            $table->mediumText('sureName', 12);
            $table->mediumText('thirdName', 12);
            $table->mediumText('lastName', 12);
            $table->enum('gender', ['ذكر', 'أنثى'])->Default('ذكر');
            $table->enum('religion', ['مسلم', 'مسيحي'])->Default('مسلم');
            $table->enum('marital_status', ['متزوج', 'مطلق','أرمل','أعزب'])->Default('أعزب');
            $table->enum('status', ['متاح', 'غير متاح'])->Default('متاح');
            $table->date('birthDate');
            $table->date('hiredAt');
            $table->string('phone', 15);
            $table->foreignIdFor(Department::class);
            $table->string('email', 30);
            $table->string('position', 15);
            $table->longText('qualifications');
            $table->foreignIdFor(Branch::class);
            $table->longText('address');
            $table->string('image');
            $table->index('id');
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
        Schema::dropIfExists('employees');
    }
};

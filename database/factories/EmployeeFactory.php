<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    
    public function definition()
    {
        return [
            'id'=>fake()->unique()->idNumber(),
            'firstName'=>fake()->unique()->firstName(),
            'sureName'=>fake()->unique()->firstNameMale(),
            'thirdName'=>fake()->unique()->firstNameMale(),
            'lastName'=>fake()->unique()->firstNameMale(),
            'gender'=>fake()->randomElement(['أنثى', 'ذكر']),
            'religion'=>'مسلم',
            'marital_status'=>fake()->randomElement(['أعزب', 'متزوج','مطلق']),
            'status'=>fake()->randomElement(['متاح', 'غير متاح']),
            'birthDate'=>fake()->unique()->date('Y-m-d'),
            'hiredAt'=>fake()->unique()->date('Y-m-d'),
            'phone'=>fake()->unique()->phoneNumber(),
            'email'=>fake()->unique()->safeEmail(),
            'position'=>fake()->randomElement(['محاسب','مهندس شبكات','مدير','سكرتير']),
            'qualifications'=>fake()->jobTitle(),
            'department_id'=>fake()->randomElement([1,2,3]),
            'branch_id'=>fake()->randomElement([1,2,3]),
            'address'=>fake()->streetAddress(),
            'image'=>'eaxpXXX157wJULSga2ukYHxqNzRQJbioqpIH4o9R.jpg'
        ];
    }
}

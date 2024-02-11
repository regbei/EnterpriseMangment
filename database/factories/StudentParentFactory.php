<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentParent>
 */
class StudentParentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => fake()->number(),
            'firstName' => fake()->name(),
            'sureName' =>  fake()->name(),
            'thirdName' =>  fake()->name(),
            'lastName' =>  fake()->name(),
            'proffission' =>  fake()->title(),
            'remember_token' => Str::random(10),
        ];
    }
}

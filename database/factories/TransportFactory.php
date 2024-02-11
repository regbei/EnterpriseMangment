<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TransportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id'=>Random::number(10),
            'driverName'=>faker()->name(),
            'title'=>faker()->title(),
            'vehicle_number'=>Str::Random(10),
            'vehicle_route'=>faker()->location(),
        ];
    }
}

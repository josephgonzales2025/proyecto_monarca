<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Individual;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Individual>
 */
class IndividualFactory extends Factory
{

    protected $model = Individual::class;

    public function definition(): array
    {
        return [
            'client_id' => Client::factory(), // Genera un cliente automáticamente
            'name' => $this->faker->name(),
            'dni' => $this->faker->unique()->numerify('########'),
            'email' => $this->faker->unique()->safeEmail(),
            'cellphone' => $this->faker->numerify('9########'),
            'address' => $this->faker->address()
        ];
    }
}

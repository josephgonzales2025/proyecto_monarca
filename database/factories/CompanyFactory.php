<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'company_name' => $this->faker->company(),
            'ruc' => $this->faker->unique()->numerify('20#########'),
            'email' => $this->faker->unique()->companyEmail(),
            'cellphone' => $this->faker->numerify('9########'),
            'address' => $this->faker->address(),
        ];
    }
}

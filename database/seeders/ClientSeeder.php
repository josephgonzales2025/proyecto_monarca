<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Individual;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 10 clientes individuales
        Individual::factory()->count(10)->create();

        // Crear 5 clientes empresas
        Company::factory()->count(5)->create();
    }
}

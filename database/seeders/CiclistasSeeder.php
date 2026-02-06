<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ciclista;

class CiclistasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ciclista::factory()->count(3)->create();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CiclistasSeeder::class,
            TipoComponenteSeeder::class,
            BloqueEntrenamientoSeeder::class,
            BicicletaSeeder::class,
            PlanEntrenamientoSeeder::class,
            HistoricoCiclistaSeeder::class,
            SesionEntrenamientoSeeder::class,
            SesionBloqueSeeder::class,
            ComponentesBicicletaSeeder::class,
            EntrenamientoSeeder::class,
        ]);
        
    }
}

<?php

namespace Database\Seeders;

use App\Models\TypeConge;
use Illuminate\Database\Seeder;

class TypeCongeSeeder extends Seeder
{
    public function run(): void
    {
        $types = ['Annuel', 'Maladie', 'Formation'];

        foreach ($types as $libelle) {
            TypeConge::firstOrCreate(['libelle' => $libelle]);
        }
    }
}
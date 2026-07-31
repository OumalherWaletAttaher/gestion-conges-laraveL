<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\TypeConge;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Types de congé et migration des données existantes
        $this->call([
            TypeCongeSeeder::class,
            MigrateExistingDataSeeder::class,
        ]);

        // Manager de démo
        User::firstOrCreate(
            ['email' => 'manager@demo.com'],
            [
                'name'     => 'Manager Demo',
                'password' => Hash::make('password'),
                'role'     => 'manager',
            ]
        );

        // Employés de démo
        $employes = [
            ['name' => 'Alice Martin',  'email' => 'alice@demo.com'],
            ['name' => 'Bob Dupont',    'email' => 'bob@demo.com'],
            ['name' => 'Claire Morin',  'email' => 'claire@demo.com'],
        ];

        foreach ($employes as $data) {
            User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name'     => $data['name'],
                    'password' => Hash::make('password'),
                    'role'     => 'employe',
                ]
            );
        }
    }
}

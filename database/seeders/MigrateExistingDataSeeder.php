<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MigrateExistingDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Type Congés
        $typeConges = [
            [
                'id' => 1,
                'libelle' => 'Annuel',
                'created_at' => '2026-07-21 11:09:41',
                'updated_at' => '2026-07-21 11:09:41',
            ],
            [
                'id' => 2,
                'libelle' => 'Maladie',
                'created_at' => '2026-07-21 11:09:41',
                'updated_at' => '2026-07-21 11:09:41',
            ],
            [
                'id' => 3,
                'libelle' => 'Formation',
                'created_at' => '2026-07-21 11:09:41',
                'updated_at' => '2026-07-21 11:09:41',
            ],
        ];

        foreach ($typeConges as $tc) {
            DB::table('type_conges')->updateOrInsert(['id' => $tc['id']], $tc);
        }

        // 2. Seed Users
        $users = [
            [
                'id' => 1,
                'name' => 'Famoussa Coulibaly',
                'email' => 'famoussa@gmail.com',
                'role' => 'employe',
                'email_verified_at' => null,
                'password' => '$2y$12$G7yMwWijALp37mbIaLs/mOOEzbMg35U7fwluH2g/hnxaQHKv5fKKm',
                'remember_token' => null,
                'created_at' => '2026-07-21 10:46:55',
                'updated_at' => '2026-07-21 10:46:55',
            ],
            [
                'id' => 2,
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'role' => 'employe',
                'email_verified_at' => null,
                'password' => '$2y$12$q9AxQMYx6luX5siIxIdYu.LUtR3YCwHHsPZpS49p9pcRs.Hle4xNa',
                'remember_token' => null,
                'created_at' => '2026-07-21 10:52:29',
                'updated_at' => '2026-07-21 10:52:29',
            ],
            [
                'id' => 3,
                'name' => 'A',
                'email' => 'a@gmail.com',
                'role' => 'employe',
                'email_verified_at' => null,
                'password' => '$2y$12$A6qgH1EeYuY80Enn3zg1ke5BVoz0dM6wtkokIYm2qIxUZEk8Qmc82',
                'remember_token' => null,
                'created_at' => '2026-07-21 11:45:04',
                'updated_at' => '2026-07-21 11:45:04',
            ],
            [
                'id' => 4,
                'name' => 'Manager Demo',
                'email' => 'manager@demo.com',
                'role' => 'manager',
                'email_verified_at' => null,
                'password' => '$2y$12$2Lhvk4u5zaVPrAgqbSu6neuFwhIPat6O15UXRIHsDXQyrEZjtaCIe',
                'remember_token' => null,
                'created_at' => '2026-07-21 11:54:22',
                'updated_at' => '2026-07-21 11:54:22',
            ],
            [
                'id' => 5,
                'name' => 'Alice Martin',
                'email' => 'alice@demo.com',
                'role' => 'employe',
                'email_verified_at' => null,
                'password' => '$2y$12$zksJqIA8.htyyKMtnHFJSO.x44D08FlHPe3fxAf2Ei0rm9KaLSJmK',
                'remember_token' => null,
                'created_at' => '2026-07-21 11:54:23',
                'updated_at' => '2026-07-21 11:54:23',
            ],
            [
                'id' => 6,
                'name' => 'Bob Dupont',
                'email' => 'bob@demo.com',
                'role' => 'employe',
                'email_verified_at' => null,
                'password' => '$2y$12$XQO1c4tCwkSpQoeN1fuCPuMLCVJVJ1.gmKxnmmUdzByPKDmR/8EyW',
                'remember_token' => null,
                'created_at' => '2026-07-21 11:54:23',
                'updated_at' => '2026-07-21 11:54:23',
            ],
            [
                'id' => 7,
                'name' => 'Claire Morin',
                'email' => 'claire@demo.com',
                'role' => 'employe',
                'email_verified_at' => null,
                'password' => '$2y$12$ErrL0FIqAlIrqKpH9p3BL.jE2m98GHaU1HoDwuF9b6Iz3T1dGUhYe',
                'remember_token' => null,
                'created_at' => '2026-07-21 11:54:23',
                'updated_at' => '2026-07-21 11:54:23',
            ],
            [
                'id' => 8,
                'name' => 't',
                'email' => 't@t.com',
                'role' => 'employe',
                'email_verified_at' => null,
                'password' => '$2y$12$OhrdufXPGIgewCrH2H2./OPUy3sMdpdC0fyh.CDEFUk0TlcUUfkJa',
                'remember_token' => null,
                'created_at' => '2026-07-21 11:58:41',
                'updated_at' => '2026-07-21 11:58:41',
            ],
            [
                'id' => 9,
                'name' => 'm',
                'email' => 'mh@gmail.com',
                'role' => 'manager',
                'email_verified_at' => null,
                'password' => '$2y$12$P4I9Lpd0BCggd9Wyfx1X5eFQDrVWHFujhN9gtXLwImo3ZU1ZexoDW',
                'remember_token' => null,
                'created_at' => '2026-07-21 12:07:48',
                'updated_at' => '2026-07-21 12:07:48',
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(['id' => $user['id']], $user);
        }

        // 3. Seed Demande Conges
        $demandes = [
            [
                'id' => 1,
                'user_id' => 1,
                'type_conge_id' => 3,
                'date_debut' => '2026-07-21',
                'date_fin' => '2026-07-28',
                'motif' => 'YH',
                'statut' => 'valide',
                'created_at' => '2026-07-21 11:43:24',
                'updated_at' => '2026-07-21 12:01:34',
            ],
            [
                'id' => 2,
                'user_id' => 3,
                'type_conge_id' => 1,
                'date_debut' => '2026-07-21',
                'date_fin' => '2026-07-31',
                'motif' => 'tst',
                'statut' => 'refuse',
                'created_at' => '2026-07-21 12:02:57',
                'updated_at' => '2026-07-21 12:03:08',
            ],
        ];

        foreach ($demandes as $demande) {
            DB::table('demande_conges')->updateOrInsert(['id' => $demande['id']], $demande);
        }

        // Fix PostgreSQL auto-increment sequence values after explicit ID insertion
        if (config('database.default') === 'pgsql') {
            DB::statement("SELECT setval(pg_get_serial_sequence('users', 'id'), coalesce(max(id), 1)) FROM users;");
            DB::statement("SELECT setval(pg_get_serial_sequence('type_conges', 'id'), coalesce(max(id), 1)) FROM type_conges;");
            DB::statement("SELECT setval(pg_get_serial_sequence('demande_conges', 'id'), coalesce(max(id), 1)) FROM demande_conges;");
        }
    }
}

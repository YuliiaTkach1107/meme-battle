<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
    {
        // On crée un admin
        User::factory()->create([
            'name' => 'Admin1 User',
            'email' => 'admin1@example.com',
            'role_id' => 1,
        ]);

        // 10 auteurs
        User::factory(10)->create([
            'role_id' => 2,
        ]);

        // On crée notre utilisateur de test qui sera maintenant un utilisateur lambda
        User::factory()->create([
            'name' => 'User1 User',
            'email' => 'test1@example.com',
            'role_id' => 3,
        ]);

        // 10 utilisateurs lambda
        User::factory(10)->create([
            'role_id' => 3,
        ]);
    }
}

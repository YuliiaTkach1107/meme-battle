<?php

namespace Database\Seeders;

use App\Models\Battle;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class BattleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Battle::factory()
       ->count(20)
       ->create();

    }

    
}


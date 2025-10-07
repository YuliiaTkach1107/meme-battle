<?php

/*namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Meme;

class MemeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    /*public function run(): void
    {
        
        Meme::factory()
        ->count(50)
        ->create();
    }
}*/



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Meme;
use App\Models\Battle;
use App\Models\User;

class MemeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $battles = Battle::all();

        foreach ($battles as $battle) {
            // Удаляем лишние мемы, если их больше 4
            $existingMemes = $battle->memes()->get();
            if ($existingMemes->count() > 4) {
                $existingMemes->slice(4)->each->delete();
            }

            // Сколько мемов нужно добавить, чтобы стало ровно 4
            $memesToAdd = 4 - $battle->memes()->count();

            if ($memesToAdd > 0) {
                Meme::factory()->count($memesToAdd)->create([
                    'battle_id' => $battle->id,
                    'user_id' => User::inRandomOrder()->first()->id,
                ]);
            }
        }
    }
}



<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Battle;
use Illuminate\Support\Facades\Auth;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meme>
 */
class MemeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();
        $battle = Battle::inRandomOrder()->first();

        return [
            'img_path' => function () {
                $randomName = Str::uuid();
                $imageUrl = "https://picsum.photos/1024/768.webp?random={$randomName}";
                $path = "images/{$randomName}.webp";
                Storage::disk('public')->put($path, file_get_contents($imageUrl));
                return $path;
            },
            'user_id' => $user->id,
            'battle_id'=>$battle->id,
        ];
    }
}

<?php

namespace Database\Factories;
use Illuminate\Contracts\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Battle;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Battle>
 */
class BattleFactory extends Factory
{
    protected $model = Battle::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();

        return [
            'title' => fake()->sentence(3),
            'description'=>fake()->sentence(3),
            'start_date' => $start = fake()->dateTimeBetween('-1 week','now'), 
            'end_date' => fake()->dateTimeBetween($start, '+2 weeks'),
            'user_id' => $user->id,
            
        ];
    }
}

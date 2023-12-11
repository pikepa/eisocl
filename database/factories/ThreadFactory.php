<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Channel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Thread>
 */
class ThreadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => function (){
                return User::factory()->create();
            },
            'channel_id' => function (){
                return Channel::factory()->create();
            },
            'title' => fake()->catchPhrase(),
            'body'  => fake()->paragraph()       ];
    }
}

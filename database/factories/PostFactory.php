<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'post_content' => fake()->paragraph(),
            'user_id' => User::inRandomOrder()->first()->id,
            'post_image' => fake()->imageUrl(640, 480),
            'post_views' => fake()->randomNumber(),
            'likes' => fake()->randomNumber(1, 1000),
            'unlikes' => fake()->randomNumber(1, 1000),
            'comments' => fake()->randomNumber(1, 1000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

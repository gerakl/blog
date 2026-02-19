<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::all()->random()->id,
            'title' => fake()->sentence(),
            'content' => fake()->paragraphs(3, true),
            'image_url' => 'https://picsum.photos/seed/' . fake()->uuid . '/800/600',
        ];
    }
}

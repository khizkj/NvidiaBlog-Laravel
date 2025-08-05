<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;

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
            "title"=> $this->faker->sentence(5),
            'description'=> $this->faker->sentence(500),
            'Author'=> $this->faker->name(),
            'read_time'=> $this->faker->numberBetween(3,10)."min read",
            'user_id'=> \App\Models\User::factory(),
            'image' => 'https://via.placeholder.com/600x300?text=Blog+Image'
        ];
    }
}

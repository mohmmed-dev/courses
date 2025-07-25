<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => null, // to be set in seeder
            'course_id' => null, // to be set in seeder
            'body' => $this->faker->paragraph(),
            'parent_id' => null, // to be set in seeder for replies
        ];
    }
}

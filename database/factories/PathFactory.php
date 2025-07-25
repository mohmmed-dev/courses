<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Path>
 */
class PathFactory extends Factory
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
            'category_id' => null, // to be set in seeder
            'slug' => $this->faker->unique()->slug(),
            'title' => $this->faker->sentence(3),
            'desorption' => $this->faker->paragraph(),
            'image_path' => $this->faker->imageUrl(640, 480, 'education'),
            'is_public' => $this->faker->boolean(80),
        ];
    }
}

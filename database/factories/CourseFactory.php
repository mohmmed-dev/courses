<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'teacher_id' => null, // to be set in seeder
            'category_id' => null, // to be set in seeder
            'title' => $this->faker->sentence(3),
            'slug' => $this->faker->unique()->slug(),
            'description' => $this->faker->paragraph(),
            'path_image' => $this->faker->imageUrl(640, 480, 'education'),
            'youtube_path' => 'https://youtube.com/' . $this->faker->unique()->word(),
            'language' => $this->faker->randomElement(['arabic', 'english']),
        ];
    }
}

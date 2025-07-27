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
            'thumbnail' => "https://i.ytimg.com/vi/XiRdPYcJOBQ/hqdefault.jpg",
            'youtube_id' => 'https://youtube.com/' . $this->faker->unique()->word(),
            'language' => $this->faker->randomElement(['arabic', 'english']),
        ];
    }
}

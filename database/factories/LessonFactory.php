<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_id' => null, // to be set in seeder
            'teacher_id' => null, // to be set in seeder
            'order' => $this->faker->numberBetween(1, 20),
            'title' => $this->faker->sentence(3),
            'slug' => $this->faker->unique()->slug(),
            'path_video' => $this->faker->url(),
            'views' => $this->faker->numberBetween(0, 1000),
            'hours' => $this->faker->numberBetween(0, 10),
            'minutes' => $this->faker->numberBetween(0, 59),
            'second' => $this->faker->numberBetween(0, 59),
        ];
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Path;
use App\Models\Tag;
use App\Models\Lesson;
use App\Models\Comment;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create users
        $users = User::factory(10)->create();

        // Create categories
        $categories = Category::factory(5)->create();

        // Create teachers
        $teachers = Teacher::factory(5)->create();

        // Create tags
        $tags = Tag::factory(10)->create();

        // Create courses and relate to teachers and categories
        $courses = Course::factory(20)->make()->each(function ($course) use ($teachers, $categories) {
            $course->teacher_id = $teachers->random()->id;
            $course->category_id = $categories->random()->id;
            $course->save();
        });

        // Create paths and relate to users and categories
        $paths = Path::factory(10)->make()->each(function ($path) use ($users, $categories) {
            $path->user_id = $users->random()->id;
            $path->category_id = $categories->random()->id;
            $path->save();
        });

        // Attach tags to courses and paths
        // foreach ($courses as $course) {
        //     $course->tags()->attach($tags->random(rand(1, 3))->pluck('id')->toArray());
        // }
        // foreach ($paths as $path) {
        //     $path->tags()->attach($tags->random(rand(1, 3))->pluck('id')->toArray());
        // }

        // Create lessons and relate to courses and teachers
        $lessons = Lesson::factory(50)->make()->each(function ($lesson) use ($courses, $teachers) {
            $lesson->course_id = $courses->random()->id;
            $lesson->teacher_id = $teachers->random()->id;
            $lesson->save();
        });

        // Attach users to courses (user_courses pivot)
        // foreach ($users as $user) {
        //     $user->courses()->attach($courses->random(rand(1, 5))->pluck('id')->toArray(), [
        //         'status' => 'continuous',
        //         'is_favorite' => rand(0, 1),
        //         'nomination' => rand(0, 1),
        //     ]);
        // }

        // Attach users to lessons (user_lessons pivot)
        // foreach ($users as $user) {
        //     $user->lessons()->attach($lessons->random(rand(1, 5))->pluck('id')->toArray(), [
        //         'status' => 'continuous',
        //         'stop' => null,
        //         'notes' => null,
        //     ]);
        // }

        // Attach users to paths (user_paths pivot)
        // foreach ($users as $user) {
        //     $user->paths()->attach($paths->random(rand(1, 3))->pluck('id')->toArray(), [
        //         'status' => 'continuous',
        //         'step' => rand(0, 5),
        //     ]);
        // }

        // Attach courses to paths (course_paths pivot)
        // foreach ($paths as $path) {
        //     $path->courses()->attach($courses->random(rand(1, 5))->pluck('id')->toArray(), [
        //         'order' => rand(1, 10),
        //     ]);
        // }

        // Create comments and relate to users and courses
        $comments = Comment::factory(30)->make()->each(function ($comment) use ($users, $courses) {
            $comment->user_id = $users->random()->id;
            $comment->course_id = $courses->random()->id;
            $comment->save();
        });

        // Optionally, create replies for some comments
        $comments->random(10)->each(function ($comment) use ($comments) {
            $reply = Comment::factory()->make([
                'user_id' => $comment->user_id,
                'course_id' => $comment->course_id,
                'parent_id' => $comment->id,
            ]);
            $reply->save();
        });
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    //

    public function show(Lesson $lesson)
    {
        $lesson->load(['course'])->loadCount(['users as is_completed' => function ($query) {
            $query->where('user_lesson.is_completed', true)
                ->where('user_lesson.user_id', auth()->id());
        }]);
        $course = $lesson->course;
        $lessons = $course->lessons()->orderBy('order')->get();
        $hoers_add_zero = sprintf('%02d', $lesson->hours);
        $minutes_add_zero = sprintf('%02d', $lesson->minutes);
        $second_add_zero = sprintf('%02d', $lesson->second);
        $time = $hoers_add_zero . ':' . $minutes_add_zero . ':' . $second_add_zero;
        return view('lessons.show', compact('lesson', 'course', 'lessons','time'));
    }
}

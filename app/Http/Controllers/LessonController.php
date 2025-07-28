<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    //

    public function show(Lesson $lesson)
    {
        $course = $lesson->course;
        $lessons = $course->lessons()->orderBy('order')->get();
        return view('lessons.show', compact('lesson', 'course', 'lessons'));
    }
}

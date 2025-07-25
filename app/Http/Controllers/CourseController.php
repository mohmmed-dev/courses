<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::paginate(30);
        return view('courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        $course->load(['lessons']);
        $lessons = $course->lessons;
        $lesson = $lessons->first();
        return view('courses.show', compact('course', 'lessons', 'lesson'));
    }
}

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
        $course->loadCount(["users","lessons","lessons as completed_lessons_count" => function($query) {
            $query->whereHas('users', function ($q) {
            $q->where('user_id', auth()->id())->where("is_completed",true);
            });
        }]);

        $lessons = $course->lessons;
        return view('courses.show', compact('course', 'lessons'));
    }
}

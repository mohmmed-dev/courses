<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,Teacher $teacher)
    {
        $teacher = $teacher->load(['courses' => function ($query) {
            // $query->where('status', 'published');
        }])->loadCount('courses');
        $courses = $teacher->courses()->with('teacher')->paginate(10);
        return view('teachers.show',compact('teacher','courses'));
    }
}

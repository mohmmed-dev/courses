<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,Tag $tag)
    {
        $tag = $tag->load(['paths','courses.teacher' => function ($query) {
            // $query->where('status', 'published');
        }])->loadCount('courses');
        $courses = $tag->courses()->paginate(10);
        $paths = $tag->paths;
        return view('tags.show',compact('paths','courses'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Path;
use App\Helpers\TimeHandling;
use Illuminate\Http\Request;

class PathController extends Controller
{
    public function show(Path $path) {
        $path->load(['courses' => function($query) {
            $query->orderBy('order', 'asc');
            $query->withCount("lessons");
            $query->with("teacher");
            $query->withExists(['completedByUsers' => function ($query) {
                $query->where('user_id', auth()->id());
            }]);
        }  ,'tags', 'category'])->loadCount(['users', 'courses']);
        $lessons_count = 0;
        $totalTime = 0;
        $totalCompleted  = 0;
        foreach ($path->courses as $course) {
            $lessons_count += $course->lessons_count;
            $totalTime += TimeHandling::TimeToSeconds($course->time);
            if($course->completed_by_users_exists) {
                $totalCompleted++;
            }
        }
        $progress = [
            'completed' => $totalCompleted,
            'remaining' => $path->courses_count - $totalCompleted,
            'total' => $path->courses_count
        ];
        $totalTime = TimeHandling::SecondsToTime($totalTime);
        return view('paths.show',compact('path',"lessons_count","totalTime",'progress'));
    }
}

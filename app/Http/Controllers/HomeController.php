<?php

namespace App\Http\Controllers;

use Alaouy\Youtube\Facades\Youtube;
use App\Helpers\Slug;
use App\Models\Course;
use App\Models\Path;
use Exception;
use Illuminate\Http\Request;



class HomeController extends Controller
{
    public function index()
    {

        // watch?v=cTvqNc82NJ0&list=PLDoPjvoNmBAz7wegzgoJvVJdr-WwE5Pwt
        // $video = Youtube::getVideoInfo('cTvqNc82NJ0');


        // $channel = Youtube::getChannelById('UCk1SpWNzOs4MYmr0uICEntg');

        // // Get playlist by ID, return an STD PHP object
        // $playlist = Youtube::getPlaylistById('PLDoPjvoNmBAz7wegzgoJvVJdr-WwE5Pwt');
        // $info = $playlist;

        // // Get playlists by multiple ID's, return an array of STD PHP objects
        // $playlists = Youtube::getPlaylistById(['PL590L5WQmH8fJ54F369BLDSqIwcs-TCfs', 'PL590L5WQmH8cUsRyHkk1cPGxW0j5kmhm0']);

        // // Get playlist by channel ID, return an array of PHP objects
        // $playlists = Youtube::getPlaylistsByChannelId('UCk1SpWNzOs4MYmr0uICEntg');

        // // Get items in a playlist by playlist ID, return an array of PHP objects
        // $lessons = Youtube::getPlaylistItemsByPlaylistId('PLDoPjvoNmBAz7wegzgoJvVJdr-WwE5Pwt');
        // foreach($lessons['results'] as $lesson) {
        //     $info = $lesson->snippet;
        //     $title = $info->title;
        //     $description = $info->description;
        //     $order = $info->position;
        //     $title = $info->thumbnails->high->url;
        //     dump($lesson);
        // }


        // $lessons = Youtube::getPlaylistItemsByPlaylistId('PLoP3S2S1qTfCUdNazAZY1LFALcUr0Vbs9');
        // $data = $this->getPlaylistVideos('PLoP3S2S1qTfCUdNazAZY1LFALcUr0Vbs9');
        // dd($data);

        $courses = Course::with(["teacher" => function($query) {
        $query->select('id',"slug","name");
        }])
        ->withAvg(['users' => function ($query) {
            $query->where('course_user.is_completed', true);
        }], 'course_user.value')
        ->paginate(20);
        $paths = Path::all();
        return view('home' , compact('courses','paths'));
    }

    public function search(Request $request) {
        $courses = Course::where("title", "Like","%$request->search%")->paginate(5);
        $paths = Path::where("title","Like","%$request->search%")->get();
        $title = $request->search;

        return view("search",compact("courses","paths","title"));
    }
}

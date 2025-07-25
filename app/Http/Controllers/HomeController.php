<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Google\Client;
use Google\Service\YouTube;


class HomeController extends Controller
{
    public function index()
    {
        $apiKey = 'AIzaSyAWEuaOUdFXBOr7bJyrO1WaaiQs0Eb-L5Q';
        $client = new Client();
        $client->setDeveloperKey($apiKey);
        $server = new YouTube($client);
        $response = $server->search->listSearch('snippet', [
            'q' => 'Laravel',
            'maxResults' => 10,
            'type' => 'video',
        ]);

        dd($response);
        $courses = Course::paginate(30);
        return view('home' , compact('courses'));
    }
}

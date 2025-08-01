<?php

namespace App\Http\Controllers;

use App\Models\Path;
use Illuminate\Http\Request;

class PathController extends Controller
{
    public function index()
    {
        $paths = Path::paginate(30);
        return view('paths.index' , compact('paths'));
    }

    public function show(Path $path) {
        
        return view('paths.show',compact('path'));
    }
}

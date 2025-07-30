<?php

namespace App\Http\Controllers;

use App\Livewire\Course;
use App\Models\Category;
use App\Models\Course as ModelsCourse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category) {
        $category->load("paths");
        $courses = ModelsCourse::where("category_id", $category->id)->paginate(15);
        $paths = $category->paths;
        return view("categories.show",compact("courses","paths"));
    }
}

<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\PathController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/',  [HomeController::class, 'index'])->name('home');
Route::get('/path/{path}',  [PathController::class, 'show'])->name('path.show');
Route::get('/course/{course}',  [CourseController::class, 'show'])->name('course.show');
Route::get('/search',  [HomeController::class, 'search'])->name('search');
Route::get('/lesson/{lesson}',  [LessonController::class, 'show'])->name('lesson.show');
Route::get("/category/{category}", [CategoryController::class,"show"])->name("category.show");
Route::get("/teacher/{teacher}", TeacherController::class)->name("teacher.show");
Route::get("/tag/{tag}", TagController::class)->name("tag.show");
// Route::view("/trau", 'trau')->name("category.sho");



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/{user:username}', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/{user:username}/courses', [ProfileController::class, 'show'])->name('profile.courses');
    Route::get('/profile/{user:username}/paths', [ProfileController::class, 'show'])->name('profile.paths');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

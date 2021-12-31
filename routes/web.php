<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/email', function(){
    return new \App\Mail\NewUserWelcomeMail();
});

Route::get('/home', [\App\Http\Controllers\ProfilesController::class,'home'])->name('home');

Route::post('follow/{user}', [\App\Http\Controllers\FollowsController::class,'store']);

Route::get('/', [\App\Http\Controllers\PostsController::class,'index'])->name('post.index');

Route::get('/p/create',[\App\Http\Controllers\PostsController::class,'create'])->name('post.create');
Route::post('/p',[\App\Http\Controllers\PostsController::class,'store'])->name('post.store');

Route::get('/p/{post}',[\App\Http\Controllers\PostsController::class,'show'])->name('post.show');

Route::get('/profile/{user}', [\App\Http\Controllers\ProfilesController::class,'show'])->name('profile.show');
Route::get('/profile/{user}/replies', [\App\Http\Controllers\ProfilesController::class,'show_replies'])->name('profile.show_replies');

Route::get('/profile/{user}/edit',[\App\Http\Controllers\ProfilesController::class,'edit'])->name('profile.edit');

Route::get('/profile/{user}/following', [\App\Http\Controllers\ProfilesController::class,'following'])->name('profile.following');
Route::get('/profile/{user}/followers', [\App\Http\Controllers\ProfilesController::class,'followers'])->name('profile.followers');

Route::get('/people', [\App\Http\Controllers\ProfilesController::class,'showPeople'])->name('profile.people');

Route::patch('/profile/{user}',[\App\Http\Controllers\ProfilesController::class,'update'])->name('profile.update');



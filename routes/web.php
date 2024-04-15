<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('landing');
});

Route::controller(AuthController::class)->group(function(){
    Route::get('auth', 'index')->name('auth');
    Route::post('register', 'register')->name('register');
    Route::post('login', 'login')->name('login');
    Route::get('logout', 'logout')->name('logout');
    Route::get('home', 'home')->name('home');
    Route::post('UpdateProfile', 'update')->name('UpdateProfile');
});

Route::controller(UserController::class)->group(function(){
    Route::get('profile', 'profile')->name('profile');
    Route::get('setting', 'setting')->name('setting');
});
Route::get('/profile/{user}', [UserController::class, 'show'])->name('profile.show');

Route::get('/albums', [AlbumController::class, 'index'])->name('albums');
Route::post('/albums/create', [AlbumController::class, 'createAlbum'])->name('albums.create');
Route::get('/albums/{albumId}', [AlbumController::class, 'show'])->name('albums.show');

Route::get('/home', [PhotoController::class, 'home'])->name('home')->middleware('auth');
Route::get('/photos-create', [PhotoController::class, 'createphoto'])->name('photos.create');
Route::post('/photos/upload', [PhotoController::class, 'upload'])->name('photos.upload');
Route::post('/photos/addToAlbum', [PhotoController::class, 'addToAlbum'])->name('photos.addtoalbum');
Route::get('/photos/{id}', [PhotoController::class, 'detailFoto'])->name('photo.detail');

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

Route::post('/photos/{photo}/like', [LikeController::class, 'toggleLike'])->name('photos.like');

Route::post('/follow', [FollowController::class, 'followUser'])->name('follow');
Route::post('/unfollow', [FollowController::class, 'unfollowUser'])->name('unfollow');

Route::post('/search', [SearchController::class, 'search'])->name('search');

Route::get('/report', function () {
    if (auth()->check() && auth()->user()->role === 'admin') {
        return app(AdminController::class)->report();
    } else {
        return redirect()->route('home')->with('error', 'Unauthorized Access');
    }
})->name('report');
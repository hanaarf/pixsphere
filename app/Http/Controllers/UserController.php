<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Follow;
use App\Models\Album;
use App\Models\Ms_Users;
use App\Models\Photo;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        return view('profile');
    }

    public function setting()
    {
        return view('setting');
    }

    public function show($userId)
    {
        $user = Ms_Users::findOrFail($userId);
        $photos = Photo::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        $albums = Album::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        return view('profile-other', compact('user', 'photos', 'albums'));
    }
    
}

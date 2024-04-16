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
        $user = auth()->user();
        $userId = auth()->user()->id;
        $photos = Photo::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        $albums = Album::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        $isFollowing = null;
        $photoCount = Photo::where('user_id', $userId)->count();
        
        $followerCount = Follow::where('followed_id', $userId)->count();
        $followingCount = Follow::where('follower_id', $userId)->count();
        
        $followers = Follow::where('followed_id', $userId)->pluck('follower_id')->all();
        $followerUsers = Ms_Users::whereIn('id', $followers)->get();
        
        $following = Follow::where('follower_id', $userId)->pluck('followed_id')->all();
        $followingUsers = Ms_Users::whereIn('id', $following)->get();
    
        if (auth()->check()) {
            $loggedInUserId = auth()->user()->id;
            $isFollowing = Follow::where('follower_id', $loggedInUserId)
                                 ->where('followed_id', $userId)
                                 ->exists();
        }

        return view('profile',compact('user','albums', 'photos', 'isFollowing', 'photoCount', 'followerCount', 'followingCount', 'followerUsers', 'followingUsers'));
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
        $isFollowing = null;
    
        // Mengambil jumlah foto yang diunggah oleh pengguna
        $photoCount = Photo::where('user_id', $userId)->count();
        
        // Mengambil jumlah follower
        $followerCount = Follow::where('followed_id', $userId)->count();
    
        // Mengambil jumlah pengguna yang diikuti oleh pengguna tertentu
        $followingCount = Follow::where('follower_id', $userId)->count();
    
        // Mengambil daftar pengikut
        $followers = Follow::where('followed_id', $userId)->pluck('follower_id')->all();
        $followerUsers = Ms_Users::whereIn('id', $followers)->get();
    
        // Mengambil daftar pengguna yang diikuti
        $following = Follow::where('follower_id', $userId)->pluck('followed_id')->all();
        $followingUsers = Ms_Users::whereIn('id', $following)->get();
    
        if (auth()->check()) {
            $loggedInUserId = auth()->user()->id;
            $isFollowing = Follow::where('follower_id', $loggedInUserId)
                                 ->where('followed_id', $userId)
                                 ->exists();
        }
    
        return view('profile-other', compact('user', 'photos', 'albums', 'isFollowing', 'photoCount', 'followerCount', 'followingCount', 'followerUsers', 'followingUsers'));
    }
    
}

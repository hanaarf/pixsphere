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

class FollowController extends Controller
{
    public function followUser(Request $request)
    {
        $follow = Follow::create([
            'follower_id' => auth()->id(),
            'followed_id' => $request->followed_id,
        ]);

        return response()->json(['success' => true]);
    }

    public function unfollowUser(Request $request)
    {
        Follow::where('follower_id', auth()->id())
            ->where('followed_id', $request->followed_id)
            ->delete();

        return response()->json(['success' => true]);
    }
}

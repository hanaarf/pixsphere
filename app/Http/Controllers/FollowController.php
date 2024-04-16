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
    public function follow($id)
    {
        $followerId = Auth::id();
        $followedId = $id;

        $follow = Follow::firstOrNew(['follower_id' => $followerId, 'followed_id' => $followedId]);

        if ($follow->exists) {
            $follow->delete();
        } else {
            $follow->save(); 
        }

        return back(); 
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Photo;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggleLike(Request $request, $photoId)
    {
        $user = auth()->user();
        $photo = Photo::findOrFail($photoId);
        
        $existingLike = $photo->likes()->where('user_id', $user->id)->first();
    
        if ($existingLike) {
            $existingLike->delete();
            $isLiked = false;
        } else {
            $like = new Like();
            $like->user_id = $user->id;
            $photo->likes()->save($like);
            $isLiked = true;
        }
    
        return response()->json(['isLiked' => $isLiked]);
    }
}

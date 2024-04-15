<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Like;
use App\Models\Photo;
use App\Models\Comment;
use App\Models\Ms_Users;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $userId = Auth::id();
        $likedPhotos = Like::where('user_id', $userId)->pluck('photo_id');
        $likedPhotoIds = $likedPhotos->toArray(); 
        $keyword = $request->input('search');
        $searchType = $request->input('searchType', 'image'); 
        $users = Ms_Users::where('name', 'LIKE', "%{$keyword}%")->get();
        
        if($searchType === 'image') {
            $photos = Photo::whereIn('user_id', $users->pluck('id'))->orderBy('created_at', 'desc')->get();
            $count = $photos->count();
        } else {
            $count = $users->count();
        }

        return view('search_result', compact('photos', 'users', 'likedPhotoIds', 'keyword', 'count', 'searchType'));
    }

}

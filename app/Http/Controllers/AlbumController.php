<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index ()
    {
        $user_id = Auth::id();
        $albums = Album::where('user_id', $user_id)->get();
        $photos = Photo::where('user_id', $user_id)->get();
        return view('gallery', compact('albums', 'photos'));
    }

    public function createAlbum(Request $request)
    {
        $album = new Album();
        $album->name = $request->input('name');
        $album->description = $request->input('description');
        
        $user_id = Auth::id();
        $album->user_id = $user_id;
        $coverPath = null;
        if ($request->hasFile('cover')) {
            $image = $request->file('cover');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('covers'), $imageName);
            $coverPath = 'covers/' . $imageName;
            $album->cover = $coverPath;
        }
        
        $album->save();

        $photoIds = $request->input('photo_ids');
        if ($photoIds) {
            foreach ($photoIds as $photoId) {
                $photo = Photo::findOrFail($photoId);
                $album->photos()->attach($photo->id);
            }
        }

        return redirect()->route('albums');
    }


    public function show($albumId)
    {
        $album = Album::with('photos', 'user')->find($albumId);
        $photos = $album->photos()->with('user')->get();
        return view('detailAlbum', compact('album', 'photos'));
    }
}

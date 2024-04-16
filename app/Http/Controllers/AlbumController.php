<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AlbumController extends Controller
{
    public function index ()
    {
        $user_id = Auth::id();
        $albums = Album::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
        $photos = Photo::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
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
        $user_id = Auth::id();
        $foto = Photo::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
        $album = Album::with('photos', 'user')->find($albumId);
        $photos = $album->photos()->with('user')->orderBy('created_at', 'desc')->get();
        return view('detailAlbum', compact('album', 'photos','foto'));
    }

    public function delete($id)
    {
        $album = Album::findOrFail($id);
        if ($album->cover) {
            $coverPath = public_path($album->cover);
            if (file_exists($coverPath)) {
                unlink($coverPath); 
            }
        }
        $album->delete();
        Alert::success('Success', 'Album deleted successfully!');

        return redirect()->back();
    }


}

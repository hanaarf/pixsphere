<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Like;
use App\Models\Photo;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PhotoController extends Controller
{
    public function home()
    {
        $userId = Auth::id();
        $likedPhotos = Like::where('user_id', $userId)->pluck('photo_id'); 
        $photos = Photo::with('user')->orderBy('created_at', 'desc')->get();
        
        $likedPhotoIds = $likedPhotos->toArray();
        
        return view('home', compact('photos', 'likedPhotoIds'));
    }
    

    public function createphoto()
    {
        $user_id = Auth::id();
        $albums = Album::where('user_id', $user_id)->get();
        return view('photo', compact('albums'));
    }

    public function upload(Request $request)
    {
        $albumId = $request->input('album_id');

        $validator = Validator::make($request->all(), [
            'photo' => 'required|file|max:5000',
            'title' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $extension = $request->file('photo')->extension();
        $imgname = date('dmyHis').'.'.$extension;
        $path = Storage::putFileAs('public/images', $request->file('photo'), $imgname);

        $user_id = Auth::id();

        $photo = Photo::create([
            'photo' => $imgname,
            'user_id' => $user_id,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        if ($albumId) {
            $album = Album::findOrFail($albumId);
            $album->photos()->attach($photo->id);
        }

        return redirect()->route('albums');
    }

    public function addToAlbum(Request $request)
    {
        $albumId = $request->input('album_id');
        $album = Album::findOrFail($albumId);

        $photoIds = $request->input('photo_ids');
        $album->photos()->attach($photoIds);

        return redirect()->route('albums.show', ['albumId' => $albumId]);
    }


    public function detailFoto($id)
    {
        $userId = Auth::id();
        $likedPhotos = Like::where('user_id', $userId)->pluck('photo_id'); 
        $photos = Photo::with('user')->orderBy('created_at', 'desc')->get();
        $likedPhotoIds = $likedPhotos->toArray();
        $photo = Photo::findOrFail($id);
        $comments = Comment::where('photo_id', $id)->with('user')->get();
        return view('detailFoto', compact('photo', 'comments','likedPhotoIds','photos'));
    }

    public function delete($id)
    {
        $photo = Photo::findOrFail($id);
        Storage::delete('public/images/' . $photo->photo);
        $photo->delete();

        // Menyimpan pesan notifikasi dalam sesi
        Alert::success('Success', 'Photo deleted successfully!');

        return redirect()->back();
    }

}

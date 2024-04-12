<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PhotoController extends Controller
{
    public function home()
    {
        $photos = Photo::with('user')->get();
        return view('home', compact('photos'));
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

        $photoId = $request->input('photo_id');

        $album->photos()->attach($photoId);
        return redirect()->route('albums');
    }

    public function detailFoto($id)
    {
        $photo = Photo::findOrFail($id);
        $comments = Comment::where('photo_id', $id)->with('user')->get();
        return view('detailFoto', compact('photo', 'comments'));
    }

}

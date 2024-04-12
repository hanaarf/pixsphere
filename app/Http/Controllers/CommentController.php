<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required',
            'photo_id' => 'required',
        ]);

        $comment = new Comment();
        $comment->user_id = auth()->id();
        $comment->photo_id = $request->photo_id;
        $comment->comment = $request->comment;
        $comment->save();

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}

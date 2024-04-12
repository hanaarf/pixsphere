<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'photo_id', 'comment', 
    ];

    public function user()
    {
        return $this->belongsTo(Ms_Users::class, 'user_id');
    }
}

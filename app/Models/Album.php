<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(Ms_Users::class);
    }

    public function photos()
    {
        return $this->belongsToMany(Photo::class);
    }
}

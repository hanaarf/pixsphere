<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Ms_Users;

class AdminController extends Controller
{
    public function report(){
        $userPhotoCounts = DB::table('photos')
        ->join('ms_users', 'photos.user_id', '=', 'ms_users.id')
        ->select('ms_users.id as user_id', 'ms_users.name', DB::raw('count(*) as total_photos'), DB::raw('GROUP_CONCAT(photos.photo) as photos'))
        ->groupBy('ms_users.id', 'ms_users.name')
        ->get();
     return view('report', compact('userPhotoCounts'));
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Album;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Ms_Users;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AlbumsExport;
use PDF;

class AdminController extends Controller
{
    public function report()
    { $data = [];

        // Ambil data foto yang diurutkan berdasarkan bulan
        $photos = DB::table('photos')
            ->select(DB::raw('COUNT(*) as count, MONTH(created_at) as month'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();
    
        // Ambil data album yang diurutkan berdasarkan bulan
        $albums = DB::table('albums')
            ->select(DB::raw('COUNT(*) as count, MONTH(created_at) as month'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();
    
        // Inisialisasi array data dengan nilai 0 untuk setiap bulan
        for ($i = 1; $i <= 12; $i++) {
            $data[$i] = ['photo' => 0, 'album' => 0];
        }
    
        // Masukkan data foto ke dalam array data sesuai bulan
        foreach ($photos as $photo) {
            $data[$photo->month]['photo'] = $photo->count;
        }
    
        // Masukkan data album ke dalam array data sesuai bulan
        foreach ($albums as $album) {
            $data[$album->month]['album'] = $album->count;
        }
    
        // Ambil hanya nilai count untuk setiap bulan dari array data
        $photoCounts = array_column($data, 'photo');
        $albumCounts = array_column($data, 'album');

        $albums = Album::with(['user', 'photos'])->get();
        $photos = Photo::with('user')->get();
    
    return view('report',  compact('photoCounts', 'albumCounts','albums','photos'));
    }

    public function exportalbum()
    {

        $albums = Album::with(['user', 'photos'])->get();
        $data = [
            'title' => 'album',
            'date' => date('m/d/Y'),
            'albums' => $albums
        ]; 

        $pdf = PDF::loadView('reportalbum', $data);
        
        return $pdf->download('albums_report.pdf');
    }

    public function exportimage()
    {

        $photos = Photo::with('user')->get();
        $data = [
            'title' => 'Image',
            'date' => date('m/d/Y'),
            'photos' => $photos
        ]; 

        $pdf = PDF::loadView('reportimage   ', $data);
        
        return $pdf->download('photos_report.pdf');
    }
}

<?php

namespace App\Http\Controllers;

use Hash;
use Session;
use App\Models\Ms_Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('autentikasi');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' =>  'required',
            'password'  =>  'required'
        ]);

        $credentialsi = $request->only('username', 'password');

        if(Auth::attempt($credentialsi))
        {
            return redirect('home');
        }

        return redirect('auth')->with('success', 'Login details are not valid');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'         => 'required',
            'username'     => 'required',
            'email'        => 'required|email',
            'password'     => 'required',
            'photo_profil' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'role'         => 'required',
        ]);
        
        $data = $request->all();
        
        // Cek apakah email atau username sudah ada di database
        if (Ms_Users::where('email', $data['email'])->exists()) {
            return redirect()->back()->withErrors(['email' => 'Email already exists']);
        }
        
        if (Ms_Users::where('username', $data['username'])->exists()) {
            return redirect()->back()->withErrors(['username' => 'Username already exists']);
        }
        
        if ($request->hasFile('photo_profil')) {
            $image = $request->file('photo_profil');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('profile_images'), $imageName);
            $imagePath = 'profile_images/' . $imageName;
        } else {
            $imagePath = null;
        }
        
        Ms_Users::create([
            'name'         =>  $data['name'],
            'username'     =>  $data['username'],
            'email'        =>  $data['email'],
            'password'     =>  Hash::make($data['password']),
            'photo_profil' =>  $imageName, 
            'role'         =>  $data['role'],
        ]);
        
        return redirect()->route('auth')->with('success', 'Registration Completed, now you can log in');
        
    }

    function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect('/');
    }
    
    function home()
    {
        if(Auth::check())
        {
            return view('home');
        }
        return redirect('auth')->with('success', 'you are not allowed to access');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'bio' => 'nullable',
        ]);

        $user = auth()->user();

        $user->name = $request->name;
        $user->bio = $request->bio;

        if ($request->hasFile('photo_profil')) {
            $request->validate([
                'photo_profil' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($user->photo_profil) {
                $oldImagePath = public_path('profile_images/' . $user->photo_profil);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('photo_profil');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('profile_images'), $imageName);
            $user->photo_profil = $imageName;
        }

        $user->save();

        return redirect('setting')->with('success', 'data updated succesfully');
    }


}

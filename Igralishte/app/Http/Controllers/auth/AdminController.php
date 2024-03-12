<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }
    public function index()
    {
        return view('profile.index');
    }

    public function showLoginForm()
    {
        return view('login');
    }
    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);


        if (auth()->attempt($credentials)) {
            return redirect()->intended('/');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
    }
    public function uploadImage(Request $request)
{
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif', 
    ]);

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/images', $filename); 

        // UNCOMMENT THE FOLLOWING < UPDATE NOT KNOWN FUNCTIOn
        // auth()->user()->update(['image' => $filename]);

        return back()->with('success', 'Image uploaded successfully.');
    }

    return back()->withErrors(['image' => 'Error uploading image.']);
}
}

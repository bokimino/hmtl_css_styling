<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }
    public function index()
    {
        $admin = User::where('is_admin', true)->first();
        return view('admin.profile.index', compact('admin'));
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
    public function edit()
    {
        $admin = User::where('is_admin', true)->firstOrFail();
        return view('admin.profile.edit', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = User::where('is_admin', true)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $admin->id,
            'phone' => 'required|nullable|string|max:20',
            'image' => 'required',

        ]);

        $admin->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'image' => $request->input('image'),
        ]);

        return redirect()->route('admin.profile.edit')->with('success', 'Admin profile updated successfully.');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $admin = User::where('is_admin', true)->firstOrFail();
        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->with('error', 'The current password is incorrect.');
        }

        $admin->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('admin.profile.edit')->with('success', 'Password updated successfully.');
    }
    public function editPassword()
    {
        return view('admin.profile.editPassword');
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

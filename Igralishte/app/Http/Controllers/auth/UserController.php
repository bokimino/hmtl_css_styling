<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function registerStep1(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);
        $request->session()->put('register_email', $request->input('email'));
        $request->session()->put('register_password', $request->input('password'));

        return response()->json(['message' => 'Registration step 1 completed successfully'], 200);
    }
    public function registerStep2(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ];

        $request->validate($rules);

        $user = new User([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'is_admin' => false,
        ]);

        $user->save();

        return response()->json(['message' => 'User registered successfully'], 201);
    }
    public function registerStep3(Request $request)
    {
        $rules = [
            'image' => 'nullable|image',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'biography' => 'nullable|string',
        ];

        $request->validate($rules);

        $user = auth()->user();

        $user->update([
            'image' => $request->file('image') ? $request->file('image')->store('images', 'public') : null,
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'biography' => $request->input('biography'),
        ]);

        return response()->json(['message' => 'User profile updated successfully'], 200);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('Igralishte')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }
}

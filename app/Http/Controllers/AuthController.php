<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $r)
    {
        $r->validate([
            'username' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $r->username,
            'email' => $r->email,
            'password' => bcrypt($r->password)
        ]);

        return response()->json(['message' => 'Register berhasil'], 201);
    }

    public function login(Request $r)
    {
        if (!Auth::attempt($r->only('email', 'password'))) {
            return response()->json(['message' => 'Login gagal'], 401);
        }

        $token = $r->user()->createToken('auth_token')->plainTextToken;
        return response()->json(['token' => $token]);
    }

    public function logout(Request $r)
    {
        $r->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout berhasil']);
    }
}
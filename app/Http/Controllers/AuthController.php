<?php

namespace App\Http\Controllers;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string|max:20',
        ]);

        $user = User::create([
            'name' => $request -> name,
            'fullname' => $request -> fullname,            
            'email' => $request -> email,            
            'password' => Hash::make($request->password),            
            'phone' => $request -> phone            
        ]);

        $token = $user->createToken('auth-token')->plainTextToken;
        return response()->json([
            'message' => 'User registered successfully',
            'access_token' => $token,
            'token_type' => 'Bearer'
        ], 201);
    }

    function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user->tokens()->delete();

        return response()->json([
        'access_token' => $user->createToken('auth-token')->plainTextToken,
        'token_type' => 'Bearer'
]);

    }

    function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'logout success']);
    }
}

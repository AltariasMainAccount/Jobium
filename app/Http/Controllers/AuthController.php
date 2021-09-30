<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
    // Registration Function
    public function register(Request $request)  {
        $validData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validData['name'],
            'email' => $validData['email'],
            'password' => Hash::make($validData['password']),
            'companies' => '[1, 2, 3]'
        ]);

        return response()->view('index');
    }

    // Login function
    public function login(Request $request) {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid login details'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        
        $token = $user->createToken('auth_token', ['user:view', 'company:view', 'job:view'])->plainTextToken;

        return response()->view('dashboard', ["token"=>$token]);
    }

    // checkMyself function
    public function checkMyself(Request $request) {
        return $request->user();
    }

    // signout function
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return redirect('index');
    }
}

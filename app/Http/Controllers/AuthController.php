<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthController extends Controller {
    // Registration Function
    public function register(Request $request) {
        $fields = $request->validate([ // validate inputs
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|min:8'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'companies' => serialize([1,2,3,4,5,6,7,8,9,10])
        ]);

        $token = $user->createToken('auth_token', ['user:view', 'company:view', 'job:view'])->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        if ($request->expectsJson()) {
            return response($response, 201);
        }

        if ($request->accepts(['text/html'])) {
            return redirect()->route('home');
        }
    }

    // Login Function
    public function login(Request $request) {
        $fields = $request->validate([ // validate inputs
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response(['message' => 'Bad credentials'], 401);
        }

        $token = $user->createToken('auth_token', ['user:view', 'company:view', 'job:view'])->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        if ($request->expectsJson()) {
            return response($response, 201);
        }

        if ($request->accepts(['text/html'])) {
            return view('dashboard', ['token' => $token]);
        }
    }

    // signout function
    public function logout(Request $request) {
        auth()->user()->tokens()->delete();
        
        if ($request->expectsJson()) {
            return ['message' => 'Logged out'];
        }

        if ($request->accepts(['text/html'])) {
            return redirect()->route('home');
        }
    }

    // checkMyself function
    public function checkMyself(Request $request) {
        return $request->user();
    }

    // Create Custom Token for an account (DEBUG - NOT FOR PRODUCTION)
    public function newToken(Request $request) {
        // The 3 permissions lists
        $userPermissionsList = [
            "user:view",
            "user:update",
            "user:create",
            "user:all"   
        ];
        $companyPermissionsList = [
            "company:view",
            "company:update",
            "company:create",
            "company:all"
        ];
        $jobPermissionsList = [
            "job:view",
            "job:update",
            "job:create",
            "job:all"
        ];
        
        $fields = $request->validate([ // validate inputs
            'email' => 'required|string',
            'tokenPerms' => 'required|array|min:3',
            'tokenPerms.0' => 'required|string',
            'tokenPerms.1' => 'required|string',
            'tokenPerms.2' => 'required|string'
        ]);

        if (in_array($fields['tokenPerms'][0], $userPermissionsList) && in_array($fields['tokenPerms'][1], $companyPermissionsList) && in_array($fields['tokenPerms'][2], $jobPermissionsList)) {
            $user = User::where('email', $fields['email'])->firstOrFail();

            auth()->user()->tokens()->delete();
            $token = $user->createToken('auth_token', [ $fields['tokenPerms'][0], $fields['tokenPerms'][1], $fields['tokenPerms'][2] ])->plainTextToken;
    
            $response = [
                'type' => 'Customized Token',
                'Field0' => [
                    'Got' => $fields['tokenPerms'][0]
                ],
                'Field1' => [
                    'Got' => $fields['tokenPerms'][1]
                ],
                'Field2' => [
                    'Got' => $fields['tokenPerms'][2]
                ],
                'user' => $user,
                'token' => $token
            ];
    
            return response($response, 201);
        } else {
            return response([
                'Error' => 'TokenPerms Array Malformed',
                'Field0' => [
                    'Expected' => 'user:view, user:update, user:create, user:all',
                    'Got' => $fields['tokenPerms'][0]
                ],
                'Field1' => [
                    'Expected' => 'company:view, company:update, company:create, company:all',
                    'Got' => $fields['tokenPerms'][1]
                ],
                'Field2' => [
                    'Expected' => 'job:view, job:update, job:create, job:all',
                    'Got' => $fields['tokenPerms'][2]
                ]
            ], 400);
        };
    }
    
    // Create Admin Token for an account (DEBUG - NOT FOR PRODUCTION)
    public function adminToken(Request $request) {
        // Request the email and set the user to that input
        $field = $request->validate([ // validate inputs
            'email' => 'required|string',
        ]);

        $user = User::where('email', $fields['email'])->firstOrFail();

        // Delete the current user token and create a new one with the permission "admin"

        auth()->user()->tokens()->delete();
        $token = $user->createToken('auth_token', ['admin'])->plainTextToken;

        // Generate the response and send it back.

        $response = [
            'type' => 'Administrative Token',
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

}

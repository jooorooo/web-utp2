<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginUserRequest;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Faker\Generator;

class UserController
{
    /**
     * Register
     */
    public function register(CreateUserRequest $request)
    {
        try {
            $user = new User();
            $user->fill($request->all());
            $user->fill(['password' => Hash::make($request->password), 'avatar' => app(Generator::class)->imageUrl(100,100)]);

            $user->save();

            $success = true;
            $message = 'User register successfully';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
        ], $success ? 200 : 401);
    }

    /**
     * Login
     */
    public function login(LoginUserRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $success = true;
            $message = 'User login successfully';
        } else {
            $success = false;
            $message = 'Invalid login credentials';
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
            'user' => Auth::user(),
        ], $success ? 200 : 401);
    }

    /**
     * Logout
     */
    public function logout()
    {
        try {
            Session::flush();
            $success = true;
            $message = 'Successfully logged out';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}

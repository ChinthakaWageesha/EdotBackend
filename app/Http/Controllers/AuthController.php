<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->name = $request->first_name . ' ' .  $request->last_name;
        $user = User::create($request->all());

        $token = auth()->login($user);
        $user = Auth::user();    
        return $this->respondWithUser($token, $user);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = Auth::user();    
        $token = auth()->login($user);
        return $this->respondWithUser($token, $user);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'name' => $token,
            'id' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60
        ]);
    }

    protected function respondWithUser($token, $user)
    {
        return response()->json(["data"=>[
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60,
            'id' => $user->id,
            'first_name' => $user->name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'mobile' => $user->mobile,
            'address' => $user->address,
            'avatar_url' => $user->avatar_url,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at
        ]]);
    }
}
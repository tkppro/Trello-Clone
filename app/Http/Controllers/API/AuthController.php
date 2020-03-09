<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\User;
use Hash;
use GuzzleHttp\Client as Client;

class AuthController extends Controller
{
    //Personal Access Client
    // public function login(LoginRequest $request)
    // {
       
    //     if (!auth()->attempt([
    //         'email' => $request->email,
    //         'password' => $request->password,
    //         ])) {

    //         return response()->json(['message'=>'Invalid credentials'], 401);
    //     }

    //     $accessToken = auth()->user()->createToken('authToken')->accessToken;

    //     return response()->json(['user' => auth()->user(), 'access_token' => $accessToken], 200);
    // }

    //Password Grant Client
    public function login(LoginRequest $request)
    {
        if (!auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return response()->json(['error'=>'Invalid credentials!'], 401);
        }

        $http = new Client;

        $response = $http->post(config('services.passport.login_endpoint'), [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => config('services.passport.client_id'),
                'client_secret' => config('services.passport.client_secret'),
                'username' => $request->email,
                'password' => $request->password,
                'scope' => '',
            ],
        ]);
        
        return json_decode((string) $response->getBody(), true);
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name,
        ]);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response()->json(['user' => $user, 'access_token' => $accessToken], 200);
    }

    public function logout()
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return response()->json('Logged out successfully', 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(StoreUserRequest $request){
        $user = new User;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->save();
        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response,201);
    }


    public function login(loginRequest $request){
        $user =  $this->checkUserCredentials($request);
        if (!$user){
            return response([
                'message' => 'Invalid credentials'
            ],401);
        }
        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response,201);
    }

    private function checkUserCredentials($request){
        $user = User::where('email',$request->email)->first();
        if ($user && Hash::check($request->password,$user->password))
        return $user;

        return null;
    }

    public function logout(Request $request)
    {
        try {
            auth()->user()->tokens()->delete();
            return response([
                'message' => 'logged out'
            ],201);
        }catch (\Exception $exception){
            return response($exception->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\AuthRegister;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use App\User;
use Hash;


class AuthController extends Controller
{
    public function authenticate(AuthRequest $request){
        $validate       = $request->validated();
        $creadentials   = $request->only(['email','password']);
        if(! $token = Auth::guard('api')->attempt($creadentials)){
            return response()->json(['error' => 'Incorect credentials'], 401);
        }

        return response()->json(compact('token'));
    }

    public function register(AuthRegister $request){
        $validate = $request->validated();
        $user = User::create([
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'password'  => Hash::make($request->input('password')),
            ]);
        
        $token = JWTAuth::fromUser($user);
        
        return response()->json(compact('token'));
    }
}

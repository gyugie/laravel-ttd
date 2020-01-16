<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\AuthRequest;
use App\Http\Request\AuthRegister;
use App\User;

class AuthController extends Controller
{
    public function authenticate(AuthRequest $request){
        $validate       = $request->validated();
        $creadentials   = $request->only(['email','password']);
        
        if(! $token = auth()->attempt($creadentials)){
            return response()->json(['error' => 'Incorect credentials'], 401);
        }

        return response()->json(compact('token'));
    }

    public function resgister(AuthRegister $request){
        $validate = $request->validated();
        $user = User::create([
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'password'  => Hash::make($request->input('password')),
            ]);
        
        $token = JWTAuth::fromUser($user);
        return response()->json($token);
    }
}

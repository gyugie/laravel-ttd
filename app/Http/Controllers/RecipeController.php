<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RecipeRequest;
use Auth;
use Validator;
use App\Recipe;

class RecipeController extends Controller
{
    public function create(RecipeRequest $request){
        $validate   = $request->validated();
        $user       = Auth::user();
        $recipe     = Recipe::create($request->only(['title','procedure']));
        $insert     = $user->recipes()->save($recipe);
        return response()->json($recipe->toArray());
    }
}

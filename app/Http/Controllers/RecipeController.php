<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\FetchRecipes;
use App\Classes\GetRecipe;
use App\Models\Recipe;

class RecipeController extends Controller
{
    public function index(Request $request) { 
        $per_page = $request->input('per_page') ?? 5;
        $query = new FetchRecipes($request);

        return view('recipes.index',
                   ['recipes' => $query->call()->paginate($per_page)
        ]);
    }

    public function show(Recipe $recipe, Request $request) {
        $query = new GetRecipe($request);
        return view('recipes.show', [
            'recipe' => $query->call()->find($recipe->id)
        ]);
    }
}

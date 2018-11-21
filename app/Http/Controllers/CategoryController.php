<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function fetchAll(): JsonResponse
    {
        return response()->json(Category::all());
    }

    public function fetchOne(string $slug)
    {
        $category = Category::query()->where('slug', $slug)->with(['recipes', 'recipes.tags'])->first();
        return response()->json($category);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function fetchAll(Request $request): JsonResponse
    {
        $this->validate($request, [
            'category_id' => 'sometimes|exists:categories,id',
        ]);

        $categoryId = $request->get('category_id');
        $recipes = Recipe::query()->when($categoryId, function (Builder $query) use ($categoryId) {
            $query->where('category_id', $categoryId);
        })->with(['tags', 'category'])->get();

        return response()->json($recipes);
    }

    public function fetchOne(string $slug): JsonResponse
    {
        $recipe = Recipe::query()->with(['ingredients' => function(BelongsToMany $query) {
            return $query->select(['*', 'quantity', 'unit_id']);
        }, 'tags', 'steps'])->where('slug', $slug)->first(['*']);
        return response()->json($recipe);
    }

    public function update(Request $request, int $recipeId): JsonResponse
    {
        $this->validate(
            $request,
            [
                'id' => 'exists:recipes,id',
                'category_id' => 'exists:categories,id',
                'title' => 'string',
                'slug' => 'string',
                'cooking_time' => 'int',
                'preparation_time' => 'int',
                'feeds' => 'int',
                'link' => 'sometimes|string',
                'picture' => 'sometimes|string',
                'thumbnail' => 'sometimes|string',
            ]
        );

        $recipeFields = $request->except(['id', 'steps', 'tags', 'ingredients']);

        /** @var Recipe $recipe */
        $recipe = Recipe::query()->where('id', $recipeId)->first();
        $recipe->update($recipeFields);

        $tagIds = collect($request->input('tags'))->pluck('id');
        $recipe->tags()->sync($tagIds);


        return response()->json($recipe->fresh('tags', 'steps'));
    }
}

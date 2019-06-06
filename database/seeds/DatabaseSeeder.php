<?php

use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Tag;
use App\Models\Unit;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->cleanup();

        $this->insertTags();
        $this->insertCategories();
        $this->insertUnits();
        $this->insertIngredients();
        $this->insertRecipes();
        $this->attachTagsToRecipes();
        $this->attachIngredientsToRecipes();
    }

    private function insertTags()
    {
        DB::table('tags')->insert(
            [
                ['title' => 'Facile'],
                ['title' => 'Long'],
                ['title' => 'Healthy'],
                ['title' => 'Party'],
                ['title' => 'Gluten free'],
                ['title' => 'Gluten full'],
                ['title' => 'Boissons'],
                ['title' => 'Paleo'],
                ['title' => 'Gourmand'],
            ]
        );
    }

    private function insertCategories()
    {
        DB::table('categories')->insert(
            [
                ['title' => 'Entrées', 'slug' => 'entrees'],
                ['title' => 'Plats Principaux', 'slug' => 'plats-principaux'],
                ['title' => 'Desserts', 'slug' => 'desserts'],
            ]
        );
    }

    private function insertUnits()
    {
        DB::table('units')->insert([
            ['title' => 'none'],
            ['title' => 'kg'],
            ['title' => 'g'],
            ['title' => 'teaspoon'],
            ['title' => 'tablespoon'],
            ['title' => 'cup'],
            ['title' => 'L'],
            ['title' => 'ml'],
        ]);
    }

    private function insertRecipes()
    {
        $categories = DB::table('categories')->newQuery()->from('categories')->get()->keyBy('slug');

        $recipes = [
            [
                'id' => 1,
                'category_id' => $categories->get('plats-principaux')->id,
                'title' => 'Couscous',
                'slug' => 'couscous',
                'description' => 'Faire cuire le poulet et le mouton

Faire cuire la semoule sur le coté

Tout mettre ensemble dans une assiette et deguster',
                'cooking_time' => 120,
                'preparation_time' => 30,
                'feeds' => 6,
            ],
        ];

        DB::table('recipes')->insert($recipes);
    }

    private function insertIngredients()
    {
        DB::table('ingredients')->insert([
            ['name' => 'Carrot'],
            ['name' => 'Courgette'],
            ['name' => 'Potato'],
            ['name' => 'Lamb chop'],
            ['name' => 'Chicken drumstick'],
            ['name' => 'Large grain Couscous'],
        ]);
    }

    private function attachTagsToRecipes()
    {
        $tags = Tag::query()->from('tags')->get()->keyBy('title')->toBase();
        $recipes = Recipe::query()->get()->keyBy('slug');

        /** @var Recipe $couscous */
        $couscous = $recipes->get('couscous');
        $couscous->tags()->sync($tags->only(['Long', 'Gluten full', 'Party'])->pluck('id'));
    }

    private function cleanup()
    {
        DB::table('tags')->delete();
        DB::table('categories')->delete();
        DB::table('recipes')->delete();
        DB::table('recipe_tag')->delete();
        DB::table('units')->delete();
        DB::table('ingredients')->delete();
        DB::table('ingredient_recipe')->delete();
    }

    private function attachIngredientsToRecipes()
    {
        /** @var Recipe $couscous */
        $couscous = Recipe::query()->where('title', 'Couscous')->first();
        /** @var Unit $noUnit */
        $noUnit = Unit::query()->where('title', 'none')->first();

        $couscous->ingredients()->attach(
            Ingredient::query()->where('name', 'Carrot')->pluck('id')->first(),
            ['unit_id' => $noUnit->getId(), 'quantity' => 3]
        );
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRecipesSchemas extends Migration
{
    public function up()
    {
        DB::transaction(function () {
            Schema::create('units', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title');
            });

            Schema::create('ingredients', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('picture')->nullable();
                $table->string('thumbnail')->nullable();
            });

            Schema::create('tags', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title');
                $table->string('color')->nullable();
            });

            Schema::create('categories', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title');
                $table->string('slug');
                $table->index('slug');
            });

            Schema::create('recipes', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('category_id');
                $table->string('title');
                $table->string('slug');
                $table->text('description');
                $table->integer('cooking_time');
                $table->integer('preparation_time');
                $table->integer('feeds');
                $table->string('link')->nullable();
                $table->string('thumbnail')->nullable();
                $table->string('picture')->nullable();
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrent();

                $table->index('slug');

                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            });

            Schema::create('ingredient_recipe', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('ingredient_id');
                $table->unsignedInteger('recipe_id');
                $table->unsignedInteger('unit_id');
                $table->integer('quantity');

                $table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade');
                $table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('cascade');
                $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            });

            Schema::create('recipe_tag', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('recipe_id');
                $table->unsignedInteger('tag_id');

                $table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('cascade');
                $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            });
        });
    }

    public function down()
    {
        Schema::dropIfExists('units');
        Schema::dropIfExists('ingredients');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('recipes');
        Schema::dropIfExists('ingredient_recipe');
        Schema::dropIfExists('recipe_tag');
    }
}

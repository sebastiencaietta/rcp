<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('categories',  ['uses' => 'CategoryController@fetchAll']);
    $router->get('categories/{slug}',  ['uses' => 'CategoryController@fetchOne']);

    $router->get('tags', ['uses' => 'TagController@fetchAll']);

    $router->get('recipes', ['uses' => 'RecipeController@fetchAll']);
    $router->get('recipes/{slug}', ['uses' => 'RecipeController@fetchOne']);
});

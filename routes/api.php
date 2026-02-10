<?php
use App\Http\Controllers\DishControllerApi;
use App\Http\Controllers\CategoryControllerApi;

Route::apiResource('categories', CategoryControllerApi::class);
Route::get('categories/{id}', [CategoryControllerApi::class, 'show']);

Route::apiResource('dishes', DishControllerApi::class);
Route::get('dishes/{id}/ingredients', [DishControllerApi::class, 'showIngredients']);

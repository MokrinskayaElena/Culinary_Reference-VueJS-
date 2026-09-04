<?php
use App\Http\Controllers\DishControllerApi;
use App\Http\Controllers\CategoryControllerApi;
use App\Http\Controllers\AuthController;

// ПУБЛИЧНЫЕ МАРШРУТЫ (ДОСТУПНЫ ВСЕМ)
// Аутентификация
Route::post('/login', [AuthController::class, 'login']);

// Просмотр категорий 
Route::get('/categories', [CategoryControllerApi::class, 'index']);
Route::get('/categories/{id}', [CategoryControllerApi::class, 'show']);

// Просмотр блюд 
Route::get('/dishes', [DishControllerApi::class, 'index']);
Route::get('/dishes/{id}', [DishControllerApi::class, 'show']);
Route::get('/dishes/{id}/ingredients', [DishControllerApi::class, 'showIngredients']);
// Поиск блюд
Route::get('/search', [DishControllerApi::class, 'search']);

// ЗАЩИЩЕННЫЕ МАРШРУТЫ (ТРЕБУЮТ ТОКЕН) 
Route::middleware('auth:sanctum')->group(function () {
    
    // Маршруты для пользователя
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Управление категориями (CRUD) 
    Route::post('/categories', [CategoryControllerApi::class, 'store']); 
    Route::put('/categories/{id}', [CategoryControllerApi::class, 'update']); 
    Route::delete('/categories/{id}', [CategoryControllerApi::class, 'destroy']); 
    
    // Управление блюдами (CRUD)
    Route::post('/dishes', [DishControllerApi::class, 'store']);
    Route::put('/dishes/{id}', [DishControllerApi::class, 'update']);  
    Route::delete('/dishes/{id}', [DishControllerApi::class, 'destroy']);
});

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;

class DishControllerApi extends Controller
{
    public function index()
    {
        $dishes = Dish::with('category')->get();
        return response()->json($dishes);
    }
    // public function index(Request $request)
    // {
    //     $perPage = $request->get('perpage', 5);
    //     $dishes = Dish::with('category')->paginate($perPage);
    //     return response()->json($dishes);
    // }
    
    public function showIngredients($id)
    {
        $dish = Dish::with('ingredients')->findOrFail($id);
        return response()->json($dish);
    }
    
    public function show($id)
    {
        $dish = Dish::with('category')->findOrFail($id);
        return response()->json($dish);
    }

   
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id', 
            'name' => 'required|string|max:255',
            'preparation_method' => 'required|string|max:500',
            'preparation_time' => 'required|integer|min:1',
        ]);
        $validated['user_id'] = auth()->id();

        $dish = Dish::create($validated);
        return response()->json($dish, 201); 
    }

    
    public function update(Request $request, $id)
    {
        $dish = Dish::findOrFail($id);

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'preparation_method' => 'required|string|max:500',
            'preparation_time' => 'required|integer|min:1',
        ]);

        $dish->update($validated);
        return response()->json($dish);
    }

    
    public function destroy($id)
    {
        $dish = Dish::findOrFail($id);

        $dish->delete();
        return response()->json(['message' => 'Рецепт успешно удален.']);
    }

}
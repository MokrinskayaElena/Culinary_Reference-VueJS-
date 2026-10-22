<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryControllerApi extends Controller
{
    
    // public function index()
    // {       
    //     return response(Category::all());
    // }

    public function index(Request $request)
    {
        return response(Category::limit($request->perpage ?? 5)
            ->offset(($request->perpage ?? 5) * ($request->page ?? 0))
            ->get());
    }

    public function total()
    {
        return response(Category::all()->count());
    }

    
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Категория не найдена'], 404);
        }

        return response()->json($category);
    }
}
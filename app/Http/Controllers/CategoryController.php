<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index() {
    $categories = Category::all();
    return view('categories', compact('categories'));
    }

    public function show(string $id)
    {
       $category = Category::find($id);

        if (!$category) {
            abort(404); 
        }

        return view('category', ['category' => $category]);
    }
}



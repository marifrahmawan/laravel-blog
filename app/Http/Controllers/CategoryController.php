<?php

namespace App\Http\Controllers;

use App\Category;

class CategoryController extends Controller
{
    public function show($slug){
        $category = Category::with(['posts'])->where('slug', $slug)->firstOrFail();
        $items = $category->posts()->latest()->paginate(6);

        return view('searcher.category_search',[
            'items' => $items,
            'category' => $category
        ]);
    }
}

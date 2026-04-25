<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $featuredItems = Item::query()
            ->where('status', 'available')
            ->with(['user', 'categoryRecord'])
            ->where('category_id', $category->id)
            ->latest()
            ->take(10)
            ->get();

        return view('home', [
            'categories' => $categories,
            'featuredItems' => $featuredItems,
            'selectedCategory' => $category,
        ]);
    }
}

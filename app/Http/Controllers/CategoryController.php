<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function single($slug)
    {
        // Retrieve the category by slug
        $category = Category::where('slug', $slug)->orderBy('id', 'DESC')->firstOrFail();
    
        // Return the view with the category data
        return view('forum.categories.index', [
            'name' => $category->name,
            'slug' => $category->slug,
            'description' => $category->description,
            'admin_only' => $category->admin_only,
            'topics' => $category->topics()->orderBy('id', 'DESC')->paginate(10)
        ]);
    }
}
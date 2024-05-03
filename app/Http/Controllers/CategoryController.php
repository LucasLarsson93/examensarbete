<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function single ($name) {
        $category = Category::where('name', $name)->orderBy('id','DESC')->firstOrFail();
        return view('category', [
            'name' => $name,
            // kolla på laravel pagination i eloquent-dokumentationen
            'topics' => $category->topics()->orderBy('id', 'DESC')->paginate(10)
        ]);
    }
}
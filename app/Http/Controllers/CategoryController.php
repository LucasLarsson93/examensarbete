<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function single ($name) {
        $category = Category::where('name', $name)->firstOrFail();
        return view('category', ['name' => $name]);
    }
}

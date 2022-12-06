<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    final public function index()
    {
        return view('admin.categories.index', [
            'categories' => Category::all()
        ]);
    }

    final public function store()
    {
        $attributes = request()
        ->merge(['slug' => ''])
        ->validate([
            'title' => ['required', 'unique:categories,title']
        ]);
        
        $attributes['slug'] = Str::slug($attributes['title']);

        Category::create($attributes);

        return back();
    }

    final public function destroy(Category $category)
    {
        $category->delete();

        return back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    final public function index()
    {
        return view('admin.categories.index', [
            'categories' => Category::all()
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    final public function index()
    {
        $this->authorize('view', auth()->user());
        
        return view('admin.index');
    }
}

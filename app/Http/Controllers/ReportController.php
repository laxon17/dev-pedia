<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    final public function index()
    {
        return view('admin.reports.index');
    }
}

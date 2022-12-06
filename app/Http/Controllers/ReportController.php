<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    final public function index()
    {
        return view('admin.reports.index', [
            'reports' => Report::latest()->where('resolved', 0)->get()
        ]);
    }

    final public function store()
    {
        $attributes['reason'] = request('reason');
        $attributes['user_id'] = auth()->id();
        $attributes['post_id'] = request('post_id');

        Report::create($attributes);
    }

    final public function update(Report $report)
    {
        $report->update([
            'resolved' => 1
        ]);

        return back();
    }
}

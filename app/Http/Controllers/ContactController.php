<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    final public function create()
    {
        return view('contact', [
            'email' => auth()->user()->email ?? ''
        ]);
    }

    final public function store()
    {
        $data = request()->validate([
            'email' => ['required', 'email'],
            'subject' => ['required', 'string'],
            'message' => ['required', 'min:10', 'max:500', 'string']
        ]);

        Mail::to('admin@devpedia.com')
            ->send(new Contact($data));

        return back()->with('success', 'Your message was sent!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        // Simple validation
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        // You can save to DB or do other things here

        return response()->json(['success' => 'Form submitted successfully!']);
    }
}

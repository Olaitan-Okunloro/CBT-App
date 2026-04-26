<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index()
    {
        return view('support.index');
    }

    public function store(Request $request)
    {
        DB::table('support_tickets')->insert([
            'user_id' => auth()->id(),
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'open',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Support request submitted');
    }
}

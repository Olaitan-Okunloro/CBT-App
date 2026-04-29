<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportTicket;

class SupportController extends Controller
{
    public function index()
    {
        $rows = SupportTicket::where(
                'user_id',
                auth()->id()
            )
            ->latest()
            ->paginate(10);

        return view(
            'support.index',
            compact('rows')
        );
    }

    public function create()
    {
        return view('support.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required'
        ]);

        SupportTicket::create([
            'user_id' => auth()->id(),
            'subject' => $request->subject,
            'message' => $request->message,
            'status'  => 'open'
        ]);

        return redirect()
            ->route('support.index')
            ->with(
                'success',
                'Ticket submitted successfully'
            );
    }
}
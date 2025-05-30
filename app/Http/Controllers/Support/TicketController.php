<?php

namespace App\Http\Controllers\Support;

use App\Enum\Permissions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Coderflex\LaravelTicket\Models\Ticket;

class TicketController extends Controller
{
    /**
     * Display a listing of the user's tickets.
     */
    public function index()
    {
        if (!Auth::user()->can(Permissions::TicketShow)) {
            abort(403);
        }

        $tickets = Ticket::where('user_id', Auth::id())->latest()->paginate(10);
        return view('support.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new ticket.
     */
    public function create()
    {
        if (!Auth::user()->can(Permissions::TicketCreate)) {
            abort(403);
        }

        return view('support.create');
    }

    /**
     * Store a newly created ticket in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::user()->can(Permissions::TicketCreate)) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'nullable|string',
            'priority' => 'required|in:low,normal,high',
        ]);

        Ticket::create([
            'title' => $request->title,
            'message' => $request->message,
            'priority' => $request->priority,
            'user_id' => Auth::id(),
            'status' => 'open', // default
        ]);

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }

    /**
     * Display the specified ticket.
     */
    public function show($id)
    {
        if (!Auth::user()->can(Permissions::TicketShow)) {
            abort(403);
        }

        $ticket = Ticket::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('support.show', compact('ticket'));
    }
}

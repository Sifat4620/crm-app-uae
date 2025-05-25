<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class UserController extends Controller
{
    public function index()
    {
        $clients = Client::with(['user', 'orders'])->paginate(10);
        return view('client.index', compact('clients'));
    }

    public function create()
    {
        // Show client registration form
        return view('client.create');
    }

    public function store(Request $request)
    {
        // Validate and store client data
        // Client::create($request->all());
        return redirect()->route('clients.index')->with('success', 'Client registered successfully.');
    }

    public function settings()
    {
        // Client settings logic
        return view('client.settings');
    }
}

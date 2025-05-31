<?php

namespace App\Http\Controllers\Clients;

use App\Models\User;
use App\Models\Client;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $clients = Client::has('orders')->with(['user', 'orders.product'])->paginate(10);
        $orderStatuses = OrderStatus::all();

        return view('client.index', compact('clients', 'orderStatuses'));
    }

    public function status(Request $request, $status)
    {
        // // Dump the status parameter and client input, then stop execution
        // dd([
        //     'status_param' => $status,
        //     'client_id' => $request->input('client'),
        // ]);

        // The following code will NOT run because dd() stops execution
        $validStatuses = ['Active', 'Processing', 'Pending', 'Canceled', 'Terminated', 'Fraud'];

        if (!in_array($status, $validStatuses)) {
            return redirect()->back()->withErrors(['Invalid status']);
        }

        $clientId = $request->input('client');

        if (!$clientId || !Client::find($clientId)) {
            return redirect()->back()->withErrors(['Client not found']);
        }

        \App\Models\Order::where('client_id', $clientId)->update(['status' => $status]);

        return redirect()->back()->with('success', "Orders status updated to '{$status}' for client ID {$clientId}.");
    }

    /**
     * Display the client create form
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        // Show client registration form
        return view('client.create');
    }

    /**
     * Store the newly create client data to database
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'            => ['required', 'string', 'max:255'],
            'national_id'     => ['required', 'numeric'],
            'business_number' => ['required', 'numeric'],
            'country'         => ['required', 'string', 'max:100'],
            'email'           => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password'        => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $client                  = new Client();
        $client->user_id         = $user->id;
        $client->national_id     = $request->national_id;
        $client->business_number = $request->business_number;
        $client->country         = $request->country;
        $client->gender          = $request->gender;
        $client->state           = $request->state;
        $client->city            = $request->city;
        $client->zip             = $request->zip;
        $client->save();

        return redirect()->route('users.index')->with('success', 'Client Created successfully');
    }


    // public function settings()
    // {
    //     // Client settings logic
    //     return view('client.settings');
    // }
}

<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\Log;

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

        if (!$clientId || !\App\Models\Client::find($clientId)) {
            return redirect()->back()->withErrors(['Client not found']);
        }

        \App\Models\Order::where('client_id', $clientId)->update(['status' => $status]);

        return redirect()->back()->with('success', "Orders status updated to '{$status}' for client ID {$clientId}.");
    }






    // public function create()
    // {
    //     // Show client registration form
    //     return view('client.create');
    // }


    // public function settings()
    // {
    //     // Client settings logic
    //     return view('client.settings');
    // }
}

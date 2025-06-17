<?php

namespace App\Http\Controllers\Orders;

use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use App\Enum\Permissions;
use App\Models\BillingCycle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Show all orders
    public function index()
    {
        if (!Auth::user()->can(Permissions::OrderIndex)) {
            abort(403);
        }

        // Eager load client, product, and billing cycles
        $orders = Order::with(['client.user', 'product', 'billingCycles'])->get();
        return view('orders.index', compact('orders'));
    }

    // Show the form to create a new order
    public function create()
    {
        if (!Auth::user()->can(Permissions::OrderCreate)) {
            abort(403);
        }

        $clients  = Client::all();
        $products = Product::orderBy('name')->get();
        $billing  = BillingCycle::orderBy('cycle_name')->get();
        return view('orders.create', compact(['clients', 'products', 'billing']));
    }

    // Store a newly created order
    public function store(Request $request)
    {
        if (!Auth::user()->can(Permissions::OrderCreate)) {
            abort(403);
        }

        // Validate the incoming request
        $request->validate([
            'product'  => ['required', 'exists:products,id'],
            'billing'  => ['required', 'exists:billing_cycles,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        // Fetch the product price
        $product = Product::find($request->product);
        $totalPrice = $product->price * $request->quantity;

        // Get client from authenticated user
        $client = Auth::user()->client;
        if (is_null($client)) {
            return redirect()->back()->with('error', 'You can\'t create an order because no client data found for you.');
        }

        // Create the order (without billing_cycle_id)
        $order = Order::create([
            'client_id'        => $client->id,
            'product_id'       => $product->id,
            'quantity'         => $request->quantity,
            'total_price'      => $totalPrice,
            'billing_cycle_id' => $request->billing,
        ]);

        // Insert billing cycle relation into pivot table
        DB::table('order_billing_cycle')->insert([
            'order_id' => $order->id,
            'billing_cycle_id' => $request->billing,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    // Show the details of a specific order
    public function show($id)
    {
        if (!Auth::user()->can(Permissions::OrderShow)) {
            abort(403);
        }

        // Eager load client, product, billing cycles
        $order = Order::with(['client.user', 'product', 'billingCycles'])->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    // Update the status of an order
    public function status(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Validate the new status
        $request->validate([
            'status' => 'required|in:Active,Processing,Pending,Canceled,Terminated,Fraud',
        ]);

        // Update the order status
        $order->status = $request->status;
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Order status updated successfully.');
    }
}

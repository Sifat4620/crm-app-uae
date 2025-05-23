<?php

namespace App\Http\Controllers\Orders;

use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use App\Models\BillingCycle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isNull;

class OrderController extends Controller
{
    // Show all orders
    public function index()
    {
        $orders = Order::with(['product', 'client'])->get();
        return view('orders.index', compact('orders'));
    }

    // Show the form to create a new order
    public function create()
    {
        $clients  = Client::all();                               // Fetch all clients
        $products = Product::orderBy('name')->get();             // Fetch all products
        $billing  = BillingCycle::orderBy('cycle_name')->get();
        return view('orders.create', compact(['clients', 'products', 'billing']));
    }

    // Store a newly created order
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'product'  => ['required', 'exists:products,id'],
            'billing'  => ['required', 'exists:billing_cycles,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        // Fetch the product price
        $product    = Product::find($request->product);
        $totalPrice = $product->price * $request->quantity;

        $client = Auth::user()->client;
        if (is_null($client)) {
            return redirect()->back()->with('error', 'You can\'t create an order. Because no client data found to you');
        } else {
            $client_id = Auth::user()->client->id;
        }

        // Create the order
        Order::create([
            'client_id' => $client_id,
            'product_id' => $product->id,
            'billing_cycle_id' => $request->billing,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
        ]);

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    // Show the details of a specific order
    public function show($id)
    {
        $order = Order::with(['product', 'client'])->findOrFail($id);
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

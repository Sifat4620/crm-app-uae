<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Client;
use Illuminate\Http\Request;

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
        $clients = Client::all(); // Fetch all clients
        $products = Product::all(); // Fetch all products
        return view('Orders.create', compact('clients', 'products'));
    }

    // Store a newly created order
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:Active,Processing,Pending,Canceled,Terminated,Fraud',
        ]);

        // Fetch the product price
        $product = Product::find($request->product_id);
        $totalPrice = $product->price * $request->quantity;

        // Create the order
        Order::create([
            'client_id' => $request->client_id,
            'product_id' => $request->product_id,
            'status' => $request->status,
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

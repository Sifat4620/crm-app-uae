<?php

namespace App\Http\Controllers\Products;


use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Models\Order; 
use App\Models\BillingCycle;


class ProductController extends Controller
{
    // Display a listing of the products
    public function index()
    {
        $categories = ProductCategory::withCount('products')->get();
        $products = Product::all();
        $orders = Order::with('client', 'product')->get();
        $billingCycles = BillingCycle::all(); 

   
        return view('products.index', compact('categories', 'products', 'orders', 'billingCycles'));
        
    }

    // Show the form for creating a new product
    public function create()
    {
        // Fetch all categories for the dropdown selection
        $categories = ProductCategory::all();
        return view('products.create', compact('categories'));
    }

    // Store a newly created product in the database
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:product_categories,id',
            'stock_quantity' => 'required|integer',
        ]);
    
        Product::create([
            'name' => $request->product_name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'stock_quantity' => $request->stock_quantity, 
        ]);
    
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }
    

    // Display the specified product
    public function show($id)
    {
        // Fetch the product by its ID
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    // Show the form for editing the specified product
    public function edit($id)
    {
        // Fetch the product and categories for editing
        $product = Product::findOrFail($id);
        $categories = ProductCategory::all();
        return view('products.edit', compact('product', 'categories'));
    }

    // Update the specified product in the database
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:product_categories,id',
            'stock' => 'required|integer',
        ]);

        // Find the product and update it
        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'stock' => $request->stock,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // Remove the specified product from the database
    public function destroy($id)
    {
        // Find the product and delete it
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}

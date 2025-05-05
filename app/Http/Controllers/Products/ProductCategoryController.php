<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    // // Display list of categories
    // public function index()
    // {
    //     $categories = ProductCategory::all();
    //     return view('products.categories.index', compact('categories'));
    // }

    // // Show form to create a new category
    // public function create()
    // {
    //     return view('products.categories.create');
    // }

    // // Store a newly created category
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|unique:product_categories,name',
    //         'description' => 'nullable'
    //     ]);

    //     ProductCategory::create($request->only('name', 'description'));

    //     return redirect()->route('product.categories.index')->with('success', 'Category added successfully.');
    // }

    // // Show form to edit an existing category
    // public function edit($id)
    // {
    //     $category = ProductCategory::findOrFail($id);
    //     return view('products.categories.edit', compact('category'));
    // }

    // // Update the category
    // public function update(Request $request, $id)
    // {
    //     $category = ProductCategory::findOrFail($id);

    //     $request->validate([
    //         'name' => 'required|unique:product_categories,name,' . $id,
    //         'description' => 'nullable'
    //     ]);

    //     $category->update($request->only('name', 'description'));

    //     return redirect()->route('product.categories.index')->with('success', 'Category updated.');
    // }

    // // Delete a category
    // public function destroy($id)
    // {
    //     ProductCategory::findOrFail($id)->delete();
    //     return redirect()->route('product.categories.index')->with('success', 'Category deleted.');
    // }
}

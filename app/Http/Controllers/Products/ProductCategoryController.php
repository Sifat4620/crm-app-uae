<?php

namespace App\Http\Controllers\Products;

use App\Enum\Permissions;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductCategoryController extends Controller
{
    // Display list of categories
    public function index()
    {
        if (!Auth::user()->can(Permissions::ProductCategoryShow)) {
            abort(403);
        }
        $categories = ProductCategory::all();
        return view('products.categories.index', compact('categories'));
    }

    // Show form to create a new category
    public function create()
    {
        if (!Auth::user()->can(Permissions::ProductCategoryCreate)) {
            abort(403);
        }
        return view('products.categories.create');
    }

    // Store a newly created category
    public function store(Request $request)
    {
        if (!Auth::user()->can(Permissions::ProductCategoryCreate)) {
            abort(403);
        }
        $request->validate([
            'name' => 'required|unique:product_categories,name',
            'description' => 'nullable'
        ]);

        ProductCategory::create($request->only('name', 'description'));

        return redirect()->route('products.categories.index')->with('success', 'Category added successfully.');
    }

    public function show($id)
    {
        abort(404);
    }

    // Show form to edit an existing category
    public function edit($id)
    {
        if (!Auth::user()->can(Permissions::ProductCategoryEdit)) {
            abort(403);
        }
        $category = ProductCategory::findOrFail($id);
        return view('products.categories.edit', compact('category'));
    }

    // Update the category
    public function update(Request $request, $id)
    {
        if (!Auth::user()->can(Permissions::ProductCategoryEdit)) {
            abort(403);
        }

        $category = ProductCategory::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:product_categories,name,' . $id,
            'description' => 'nullable'
        ]);

        $category->update($request->only('name', 'description'));

        return redirect()->route('products.categories.index')->with('success', 'Category updated.');
    }

    // Delete a category
    public function destroy($id)
    {
        if (!Auth::user()->can(Permissions::ProductCategoryDelete)) {
            abort(403);
        }
        ProductCategory::findOrFail($id)->delete();
        return redirect()->route('products.categories.index')->with('success', 'Category deleted.');
    }
}

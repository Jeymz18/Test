<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category; // module 4
use Illuminate\Support\Facades\Storage; // ✅ Added for image handling

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // ✅ Step 1: Validate
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // ✅ image validation
        ]);

        $data = $request->except('image');

        // ✅ Step 2: Handle File Upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        }

        // ✅ Step 3: Create Product
        Product::create($data);

        // ✅ Step 4: Redirect
        return redirect()->route('admin.products.index')
                         ->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        // ✅ Step 1: Validate
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // ✅ image validation
        ]);

        $data = $request->except('image');

        // ✅ Step 2: Handle File Upload
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        }

        // ✅ Step 3: Update Product
        $product->update($data);

        // ✅ Step 4: Redirect
        return redirect()->route('admin.products.index')
                         ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // ✅ Delete image from storage
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // ✅ Delete product from database
        $product->delete();

        return redirect()->route('admin.products.index')
                         ->with('success', 'Product deleted successfully.');
    }

    public function shop()
    {
        $products = Product::with('category')->latest()->paginate(12);
        return view('shop.index', compact('products'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //We'll show all categories and a form to create a new one, all on one page.
        $categories = Category::withCount('products')->latest()->get(); // 'withCount' gets the number of products
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required|string|max:255|unique:categories',
    ]);
        Category::create($request->all());
        return redirect()->route('admin.categories.index')
                     ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Note: Because we used `onDelete('set null')` in our migration,
        // deleting a category will not delete the products.
        // It will just set their `category_id` to null.
        $category->delete();
        
        return redirect()->route('admin.categories.index')
                     ->with('success', 'Category deleted successfully.');

    }
}

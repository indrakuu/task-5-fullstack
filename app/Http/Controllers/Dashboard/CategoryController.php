<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(15);
        return view('dashboard.category.index', compact('categories'));
    }
    
    public function create()
    {
        return view('dashboard.category.create');
    }

    public function show($id)
    {
        $category = Category::find($id);
        return view('dashboard.category.detail', compact('category'));
    }

    public function store(CategoryStoreRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->user()->id;
        Category::create($validated);
        return redirect()->route('dashboard.category')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('dashboard.category.edit', compact('category'));
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        $validated = $request->validated();
        $category = Category::find($id);
        $category->update($validated);
        return redirect()->route('dashboard.category')->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if($category->articles->count() > 0)
        {
            return redirect()->route('dashboard.category')->with('error', 'Category has articles, cannot delete');
        }
        $category->delete();
        return redirect()->route('dashboard.category')->with('success', 'Category deleted successfully');
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all(); 
        
        return view('admin.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,webp,png,gif,avif|max:2048', 
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('categories', $fileName,'public');
            $validated['image'] = $fileName;
        }

        Category::create($validated);

        return redirect()->route('admin.category.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,avif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($category->image && Storage::exists('public/' . $category->image)) {
                Storage::delete('public/' . $category->image);
            }
        
            // Store the new image in the 'categories' directory
            $fileName = $request->file('image')->getClientOriginalName();
            $validated['image'] = $request->file('image')->storeAs('categories', $fileName, 'public');
            $validated['image'] = str_replace('categories/', '', $validated['image']); // Save only the file name in DB
        }

        $category->update($validated);

        return redirect()->route('admin.category.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Request $request,$id)
    {
        $category = Category::findOrFail($id);

 
        if ($category->image && Storage::exists('public/'.$category->image)) {
            Storage::delete('public/'.$category->image);
        }

        $category->delete();

        return redirect()->route('admin.category.index')->with('success', 'Category deleted successfully.');
    }
   
    
}

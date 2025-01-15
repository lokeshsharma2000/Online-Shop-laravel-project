<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class SubCategoryController extends Controller
{
   public function index(){

    $subcategories = Subcategory::all();
    return view('subcategory.index',compact('subcategories'));
   }

   public function create(Request $request){
    $categories=Category::all();


    return view('subcategory.create',compact('categories'));
   }

   public function store(Request $request)
   {
       $validated = $request->validate([
           'title' => 'required|string|max:255',
           'image' => 'nullable|image|mimes:jpg,jpeg,webp,png,gif,avif|max:2048', 
           'description'=>'nullable|string',
           'categoryID'=>'required|exists:category,id',
       ]);
       
       if ($request->hasFile('image')) {
       
           $image = $request->file('image');
           $fileName = time() . '_' . $image->getClientOriginalName();
           $imagePath = $image->storeAs('subcategories', $fileName,'public');
         
           $validated['image'] = $fileName;
        
       }
      
       Subcategory::create($validated);

       return redirect()->route('admin.subcategory.index')->with('success', 'Category created successfully.');
   }

   public function destroy(Request $request,$id)
   {
       $subcategory = Subcategory::findOrFail($id);


       if ($subcategory->image && Storage::exists('public/'.$subcategory->image)) {
           Storage::delete('public/'.$subcategory->image);
       }

       $subcategory->delete();

       return redirect()->route('admin.subcategory.index')->with('success', 'subategory deleted successfully.');
   }

   public function edit($id){
    $subcategory = Subcategory::findOrFail($id);
    $categories=Category::all();
    return view('subcategory.edit', compact('subcategory','categories'));
}
public function update(Request $request, $id)
    {
        $subcategory = Subcategory::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
           'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,avif|max:2048', 
           'description'=>'nullable|string',
           'categoryID'=>'required|exists:category,id',
       ]);
       

       if ($request->hasFile('image')) {
        if ($subcategory->image && Storage::exists('public/' . $subcategory->image)) {
            Storage::delete('public/' . $subcategory->image);
        }
    
        $fileName = $request->file('image')->getClientOriginalName();
        $validated['image'] = $request->file('image')->storeAs('subcategories', $fileName, 'public');
        $validated['image'] = str_replace('subcategories/', '', $validated['image']); 
    }
    
        $subcategory->update($validated);

        return redirect()->route('admin.subcategory.index')->with('success', 'Category updated successfully.');
    }


}

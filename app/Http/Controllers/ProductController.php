<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
   
    public function getSubcategories(Request $request)
    {
        $categoryId = $request->get('categoryID');
    
        $subcategories = SubCategory::where('categoryID', $categoryId)->get();
    
        return response()->json(['subcategories' => $subcategories]);
    }


    public function index()
    {
        $products = Product::with('category', 'subcategory')->get();
        // return $products;
        return view('products.index', compact('products'));
    }
        
    public function create(Request $request)
    {   $categories=Category::all();
        $subcategories=SubCategory::all();
        return view('products.create',compact('categories','subcategories'));
    }




public function store(Request $request){
   
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'categoryID'=>'required|exists:category,id',
        'subcategoryID'=>'required|exists:subcategory,id',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|image|mimes:jpg,jpeg,webp,png,gif|max:2048', 
        'quantity' => 'nullable|integer|min:1'
     
    ]);

    if ($request->hasFile('image')) {
       
        $image = $request->file('image');
        $fileName = time() . '_' . $image->getClientOriginalName();
        $imagePath = $image->storeAs('products', $fileName,'public');
      
        $validated['image'] = $fileName;
     
    }
    Product::create($validated);
    return Redirect()->route('admin.product.index')->with('success','Product created successfully');
}
public function edit($id){
    $products = Product::findOrFail($id);
    $categories=Category::all();
    $subcategories=SubCategory::all();
    return view('products.edit', compact('products','categories','subcategories'));
   }
    
   public function update(Request $request, $id)
   {
       $products = Product::findOrFail($id);

       $validated = $request->validate([
        'title' => 'required|string|max:255',
        'categoryID'=>'required|exists:category,id',
        'subcategoryID'=>'required|exists:subcategory,id',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|image|mimes:jpg,jpeg,webp,png,gif|max:2048', 
          'quantity' => 'nullable|integer|min:1'
      ]);
      

      if ($request->hasFile('image')) {
       if ($products->image && Storage::exists('public/' . $products->image)) {
           Storage::delete('public/' . $products->image);
       }
   
       $fileName = $request->file('image')->getClientOriginalName();
       $validated['image'] = $request->file('image')->storeAs('products', $fileName, 'public');
       $validated['image'] = str_replace('products/', '', $validated['image']); 
   }
   
       $products->update($validated);

       return redirect()->route('admin.product.index')->with('success', 'Category updated successfully.');
   }

   public function destroy($id){
$products=Product::findOrfail($id);
if($products->image && Storage::exists('public/'.$products->image)){
Storage::delete('public/'.$products->image);
}

$products->delete();

return redirect()->route('admin.product.index')->with('success','product deleted successfully.');
   
}

}

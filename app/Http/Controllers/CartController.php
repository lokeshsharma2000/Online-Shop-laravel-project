<?php
namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Only logged-in users can add to the cart
  

    public function addToCart(Request $request, $productId)
    {
        // Ensure the product exists
        $product = Product::findOrFail($productId);

        // Check if the cart already contains this product
        $existingCartItem = Cart::where('userID', auth()->id())
                                ->where('productID', $productId)
                                ->first();

        if ($existingCartItem) {
            // If the product already exists in the cart, just increase the quantity
            $existingCartItem->quantity += $request->input('quantity', 1);
            $existingCartItem->save();
        } else {
            // Otherwise, add the product to the cart
            Cart::create([
                'userID' => auth()->id(),
                'productID' => $productId,
                'quantity' => $request->input('quantity', 1),
            ]);
        }

        return redirect()->route('user.cart.index');
    }

    public function showCart()
    {
   
        $cartItems = Cart::with('product')->where('userID', auth()->id())->get();

        return view('cart.index', compact('cartItems'));
    }

    public function remove($cartItemId)
{
    $cartItem = Cart::where('id', $cartItemId)->where('userID', auth()->id())->firstOrFail();

    $cartItem->delete();

    return redirect()->back()->with('success', 'Product removed from cart.');
}
}

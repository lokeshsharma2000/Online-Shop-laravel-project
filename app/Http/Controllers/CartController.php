<?php
namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Order;

class CartController extends Controller
{
  

    public function addToCart(Request $request, $productId)
    {

        $product = Product::findOrFail($productId);
    

        $quantityToAdd = $request->input('quantity', 1);
    
  
        $existingCartItem = Cart::where('userID', auth()->id())
                                ->where('productID', $productId)
                                ->first();
    
        $currentCartQuantity = $existingCartItem ? $existingCartItem->quantity : 0;
    
      
        if ($currentCartQuantity + $quantityToAdd > $product->quantity) {
        
            return redirect()
                ->route('user.cart.index')
                ->with('error', 'You can only add up to ' . $product->quantity . ' of this product.');
        }
    
        if ($existingCartItem) {
           
            $existingCartItem->quantity += $quantityToAdd;
            $existingCartItem->save();
        } else {
       
            Cart::create([
                'userID' => auth()->id(),
                'productID' => $productId,
                'quantity' => $quantityToAdd,
            ]);
        }
    
        return redirect()->route('user.cart.index')->with('success', 'Product added to cart successfully.');
    }
    

    public function showCart()
    {
   
        $cartItems = Cart::with('product')->where('userID', auth()->id())->get();

        // dd(session()->all());

        return view('cart.index', compact('cartItems'));
    }

    public function remove($cartItemId)
{
    $cartItem = Cart::where('id', $cartItemId)->where('userID', auth()->id())->firstOrFail();

    $cartItem->delete();

    return redirect()->back()->with('success', 'Product removed from cart.');
}
public function buyNowConfirm($productId)
{
    $product = Product::findOrFail($productId);

    // Check stock availability
    if ($product->quantity < 1) {
        return redirect()
            ->back()
            ->with('error', 'This product is out of stock.');
    }

    return view('orders.buy-now-confirm', compact('product'));
}

public function processBuyNow(Request $request, $productId)
{
    $product = Product::findOrFail($productId);
    $user = auth()->user();


    if ($product->quantity < 1) {
        return redirect()->route('user.doneOrder', ['productId' => $productId])
                         ->with('error', 'The product is out of stock.');
    }

    $quantity = 1; 
    $totalPrice = $product->price * $quantity;

   
    $order = Order::create([
        'userID' => $user->id,
        'productID' => $product->id,
        'quantity' => $quantity,
        'totalPrice' => $totalPrice,
        'status' => 'Pending',
    ]);

   
    $product->update(['quantity' => $product->quantity - $quantity]);

    return view('orders.done')->with('success', 'Your purchase was successful!');
}
public function doneOrder(){
    return view('orders.done');
}


public function orders()
{
    $orders = Order::where('userID', auth()->id())->with('product')->latest()->get();

    return view('orders.index', compact('orders'));
}
public function buyNow(Request $request, $productId)
{
    $product = Product::findOrFail($productId);

    if ($product->quantity < 1) {
        return redirect()
            ->back()
            ->with('error', 'This product is out of stock.');
    }


    return redirect()->route('user.buy.now.confirm',['productId' => $product->id])->with('success', 'You can proceed to checkout.');
}


}

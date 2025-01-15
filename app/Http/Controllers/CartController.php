<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    // Add product to the cart
    public function addToCart(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $quantityToAdd = $request->input('quantity', 1);

        $existingCartItem = Cart::where('userID', auth()->id())
            ->where('productID', $productId)
            ->first();

        $currentCartQuantity = $existingCartItem ? $existingCartItem->quantity : 0;

        // Check if adding more than available stock
        if ($currentCartQuantity + $quantityToAdd > $product->quantity) {
            return redirect()
                ->route('user.cart.index')
                ->with('error', 'You can only add up to ' . $product->quantity . ' of this product.');
        }

        // Update cart item or create a new one
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
        return view('cart.index', compact('cartItems'));
    }

    public function remove($cartItemId)
    {
        $cartItem = Cart::where('id', $cartItemId)->where('userID', auth()->id())->firstOrFail();
        $cartItem->delete();

        return redirect()->back()->with('success', 'Product removed from cart.');
    }

    // Confirm the buy-now process
    public function buyNowConfirm($productId)
    {
        $product = Product::findOrFail($productId);

        if ($product->quantity < 1) {
            return redirect()->back()->with('error', 'This product is out of stock.');
        }

        return view('orders.buy-now-confirm', compact('product'));
    }

    // Process buy-now order
    public function processBuyNow(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $user = auth()->user();

        if ($product->quantity < 1) {
            return redirect()->route('user.doneOrder')->with('error', 'The product is out of stock.');
        }

        $quantity = 1;
        $totalPrice = $product->price * $quantity;

        // Create the order
        $order = Order::create([
            'userID' => $user->id, // Associate the order with the user
            'totalPrice' => $totalPrice, // Total calculated from order items
            'status' => 'Pending', // Default status
            
        ]);

        // Create order item for this product
        OrderItem::create([
            'orderID' => $order->id,
            'productID' => $product->id,
            'quantity' => $quantity,
            'price' => $product->price,
            'total' => $totalPrice,
        ]);

        // Update product stock
        $product->update(['quantity' => $product->quantity - $quantity]);

       $email= Mail::to($user->email)->send(new OrderConfirmationMail($user));


        return redirect()->route('user.doneOrder')->with('success', 'Your purchase was successful!');
    }

    // Display order confirmation
    public function doneOrder()
    {
        return view('orders.done');
    }

    // View all orders for a user
    public function orders()
    {
        // Old logic for associating orders with product directly
        // $orders = Order::where('userID', auth()->id())
        //     ->with('product')
        //     ->latest()
        //     ->get();

        // New logic for fetching orders with associated order items and products
        $orders = Order::where('userID', auth()->id())
            ->with('items.product') // Load order items and their related products
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    // Buy-now shortcut to confirmation page
    public function buyNow(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        if ($product->quantity < 1) {
            return redirect()->back()->with('error', 'This product is out of stock.');
        }

        return redirect()->route('user.buy.now.confirm', ['productId' => $product->id])
            ->with('success', 'You can proceed to checkout.');
    }

    public function orderDetail($orderID){
        $orders = OrderItem::where('orderID', $orderID)->with('product')->latest()->get();

        return view('orders.orderdetail', compact('orders'));
    
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart()
    {
        $carts = Auth::user()->carts;
        return view('site.cart', compact('carts'));
    }
    public function add_cart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|min:1'
        ]);
        $product = Product::find($request->product_id);
        Cart::updateOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id
        ], [
            'quantity' => DB::raw('quantity + ' . $request->quantity),
            'price' => $product->final_price
        ]);
        return redirect()->back()->with('msg', 'Product Added To Cart');
    }
    public function delete_cart($id)
    {

        $cart = Cart::findOrFail($id);
        $cart->delete();
        $carts = Auth::user()->carts;
        return view('site.cart-content', compact('carts'))->render();
    }
    public function delete_cart2($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        $carts = Auth::user()->carts;
        return view('site.cart-items', compact('carts'))->render();
    }
    public function update_cart(Request $request)
    {
        Cart::find($request->id)->update([
            'quantity' => $request->quantity
        ]);
        $carts = Auth::user()->carts;
        return view('site.cart-items', compact('carts'))->render();
    }
}

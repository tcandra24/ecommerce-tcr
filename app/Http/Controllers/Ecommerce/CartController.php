<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product', 'product.images')->where('customer_id', Auth::guard('customer')->user()->id)->latest()->get();

        return view('ecommerce.carts.index', ['carts' => $carts]);
    }

    public function store(Request $request)
    {
        try {
            $product = Product::select('id', 'price', 'weight')->where('slug', $request->slug)->first();
            $cart = Cart::where('product_id', $product->id)->where('customer_id', Auth::guard('customer')->user()->id);

            if($cart->count()){
                $cart->increment('qty', $request->qty);
                $cart = $cart->first();

                $total = $product->price * $cart->qty;
                $weight = $product->weight * $cart->qty;

                $cart->update([
                    'total'     => $total,
                    'weight'    => $weight
                ]);
            } else {
                Cart::create([
                    'product_id'    => $product->id,
                    'customer_id'   => Auth::guard('customer')->user()->id,
                    'qty'           => $request->qty,
                    'price'         => $product->price,
                    'total'         => $request->qty * $product->price,
                    'weight'        => $product->weight,
                ]);
            }

            $cartOnHeader = Cart::with('product', 'product.images')
            ->where('customer_id', Auth::guard('customer')->user()->id)
            ->take(10)->get();

            return response()->json([
                'success' => true,
                'carts' => $cartOnHeader,
                'message' => 'Success add to Cart'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getSimpleCartData()
    {
        try {
            $cartOnHeader = Cart::with('product', 'product.images')
            ->where('customer_id', Auth::guard('customer')->user()->id)
            ->take(10)->get();

            return response()->json([
                'success' => true,
                'carts' => $cartOnHeader,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    // public function destroy($slug)
    // {
    //     try {
    //         $product = Product::where('slug', $slug)->first();
    //         Cart::where('product_id', $product->id)->where('customer_id', Auth::guard('customer')->user()->id)->delete();

    //         $cartOnHeader = Cart::with('product', 'product.images')
    //         ->where('customer_id', Auth::guard('customer')->user()->id)
    //         ->take(10)->get();

    //         return response()->json([
    //             'success' => true,
    //             'carts' => $cartOnHeader,
    //             'message' => 'Success delete from Cart'
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => $e->getMessage()
    //         ]);
    //     }
    // }
}

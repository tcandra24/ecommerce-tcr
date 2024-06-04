<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Wishlist;
use App\Models\Product;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with('product', 'product.images')->where('customer_id', Auth::guard('customer')->user()->id)->latest()->get();

        return view('ecommerce.wishlists.index', [ 'wishlists' => $wishlists ]);
    }

    public function store(Request $request)
    {
        try {
            $product = Product::where('slug', $request->slug)->first();

            if(Wishlist::where('product_id', $product->id)->where('customer_id', Auth::guard('customer')->user()->id)->exists()){
                return response()->json([
                    'success' => true,
                    'message' => 'Product already on Wishlist'
                ]);
            }

            Wishlist::create([
                'product_id' => $product->id,
                'customer_id' => Auth::guard('customer')->user()->id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Success add to Wishlist'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function destroy($slug)
    {
        try {
            $product = Product::where('slug', $slug)->first();
            $wishlist = Wishlist::where('product_id', $product->id)->where('customer_id', Auth::guard('customer')->user()->id);
            $wishlist->delete();

            $wishlists = Wishlist::where('customer_id', Auth::guard('customer')->user()->id)->get();

            return response()->json([
                'success' => true,
                'wishlists' => $wishlists->count(),
                'message' => 'Success delete from Wishlist'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}

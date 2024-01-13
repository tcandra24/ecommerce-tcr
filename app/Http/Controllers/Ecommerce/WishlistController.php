<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with('product', 'product.images')->where('customer_id', Auth::guard('customer')->user()->id)->latest()->get();

        return view('ecommerce.wishlists.index', [ 'wishlists ' => $wishlists ]);
    }
}

<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Wishlist;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('images', 'category')->where('is_active', true)
        ->when(request()->q, function($products){
            $products = $products->where('title', 'like', '%' . request()->q . '%');
        })
        ->when(request()->price_start || request()->price_end, function($products){
            $products = $products->whereBetween('price', [request()->price_start, request()->price_end]);
        })->withExists(['wishlist' => function($query){
            $query->where('customer_id', Auth::guard('customer')->user()->id ?? null);
        }])->paginate(9);

        $categories = Category::withCount('products')->get();
        $brands = Brand::withCount('products')->get();
        $latestProducts = Product::with(['images', 'category'])->where('is_active', true)->latest()->take(3)->get();

        return view('ecommerce.products.index', [
            'products' => $products,
            'latestProducts' => $latestProducts,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    public function detail($slug)
    {
        $product = Product::with('images', 'category')->where('slug', $slug)->first();
        $onWishlist = Wishlist::where('customer_id', Auth::guard('customer')->user()->id ?? null)->where('product_id', $product->id)->exists();

        $relateProduct = Product::with('images', 'category')->withExists(['wishlist' => function($query){
            $query->where('customer_id', Auth::guard('customer')->user()->id ?? null);
        }])->where('is_active', true)->where('category_id', $product->category_id)->where('slug', '<>', $slug)->get();

        return view('ecommerce.products.detail', [
            'product' => $product,
            'relateProduct' => $relateProduct,
            'onWishlist' => $onWishlist,
        ]);
    }

    // public function search($q)
    // {
    //     $products = Product::with('images', 'category')->where('title', 'LIKE', '%' . $q . '%')->get();
    // }
}

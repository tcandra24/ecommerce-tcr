<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::paginate(12);

        return view('ecommerce.brands.index', [
            'brands' => $brands,
        ]);
    }

    public function detail($slug)
    {
        $categories = Category::withCount('products')->get();
        $brands = Brand::withCount('products')->get();

        $brand = Brand::where('slug', $slug)->first();

        $products = Product::with('images', 'category')
        ->when(request()->price_start || request()->price_end, function($products){
            $products = $products->whereBetween('price', [request()->price_start, request()->price_end]);
        })->withExists(['wishlist' => function($query){
            $query->where('customer_id', Auth::guard('customer')->user()->id ?? null);
        }])->where('is_active', true)->where('brand_id', $brand->id)->paginate(9);
        $latestProducts = Product::with(['images', 'category'])->where('is_active', true)->latest()->take(3)->get();

        return view('ecommerce.brands.detail', [
            'title' => $brand->name,
            'products' => $products,
            'latestProducts' => $latestProducts,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }
}

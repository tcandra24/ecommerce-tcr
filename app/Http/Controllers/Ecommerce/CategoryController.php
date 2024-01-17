<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(12);

        return view('ecommerce.categories.index', [
            'categories' => $categories,
        ]);
    }

    public function detail($slug)
    {
        $categories = Category::withCount('products')->get();
        $brands = Brand::withCount('products')->get();

        $category = Category::where('slug', $slug)->first();

        $products = Product::with('images', 'category')
        ->when(request()->price_start || request()->price_end, function($products){
            $products = $products->whereBetween('price', [request()->price_start, request()->price_end]);
        })->withExists(['wishlist' => function($query){
            $query->where('customer_id', Auth::guard('customer')->user()->id ?? null);
        }])->where('is_active', true)->where('category_id', $category->id)->paginate(9);
        $latestProducts = Product::with(['images', 'category'])->where('is_active', true)->latest()->take(3)->get();

        return view('ecommerce.categories.detail', [
            'title' => $category->name,
            'products' => $products,
            'latestProducts' => $latestProducts,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }
}

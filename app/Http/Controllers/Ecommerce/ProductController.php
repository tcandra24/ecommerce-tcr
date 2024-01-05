<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();
        $brands = Brand::withCount('products')->get();
        $products = Product::with('images', 'category')->where('is_active', true)->paginate(9);
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
        $relateProduct = Product::with('images', 'category')->where('category_id', $product->category_id)->where('slug', '<>', $slug)->get();

        return view('ecommerce.products.detail', [
            'product' => $product,
            'relateProduct' => $relateProduct
        ]);
    }
}

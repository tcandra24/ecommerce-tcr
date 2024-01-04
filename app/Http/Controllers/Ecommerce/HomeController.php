<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Brand;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::take(4)->orderBy('created_at')->get();
        $latestProducts = Product::with(['images', 'category'])->where('is_active', 1)->latest()->take(6)->get();
        $productByBrand = Brand::with(['products' => function($query) {
            return $query->where('is_active', 1);
        }, 'products.images', 'products.category'])->take(5)->get();
        $sliders = Slider::all();
        $brands = Brand::all();

        return view('ecommerce.index', [
            'categories' => $categories,
            'latestProducts' => $latestProducts,
            'productByBrand' => $productByBrand,
            'sliders' => $sliders,
            'brands' => $brands,
        ]);
    }
}

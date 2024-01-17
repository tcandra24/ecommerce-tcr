<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

use App\Models\Category;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Cart;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::take(4)->orderBy('created_at')->get();
        $latestProducts = Product::with(['images', 'category'])
        ->withExists(['wishlist' => function($query){
            $query->where('customer_id', Auth::guard('customer')->user()->id ?? null);
        }])->where('is_active', true)->latest()->take(6)->get();

        $productByBrand = Brand::with(['products' => function($query) {
            $query->withExists(['wishlist' => function($query){
                $query->where('customer_id', Auth::guard('customer')->user()->id ?? null);
            }])->where('is_active', true);
        }, 'products.images', 'products.category'])->take(5)->get();

        $sliders = Slider::all();
        $brands = Brand::take(10)->get();

        return view('ecommerce.index', [
            'categories' => $categories,
            'latestProducts' => $latestProducts,
            'productByBrand' => $productByBrand,
            'sliders' => $sliders,
            'brands' => $brands,
        ]);
    }
}

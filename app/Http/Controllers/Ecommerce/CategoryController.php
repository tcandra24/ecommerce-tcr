<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
// use App\Models\Brand;

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
        $category = Category::where('slug', $slug)->first();
        if(!$category){
            abort(404);
        }

        $products = Product::with('images', 'category')
        ->when(request()->price_start || request()->price_end, function($products){
            $products = $products->whereBetween('price', [request()->price_start, request()->price_end]);
        })->withExists(['wishlist' => function($query){
            $query->where('customer_id', Auth::guard('customer')->user()->id ?? null);
        }])->where('is_active', true)->where('category_id', $category->id)->paginate(9);

        return view('ecommerce.categories.detail', [
            'title' => $category->name,
            'products' => $products,
        ]);
    }
}

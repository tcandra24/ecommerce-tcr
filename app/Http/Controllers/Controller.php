<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

use App\Models\Category;
use App\Models\Cart;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $categoriesMenuHeader = Category::take(10)->get();
        View::share('categoriesMenuHeader', $categoriesMenuHeader);

        $productPerCategoryMenuHeader = Category::with('products')->take(2)->get();
        $productPerCategoryMenuHeader = $productPerCategoryMenuHeader->map(function($product){
            return $product->setRelation('products', $product->products->take(5));
        });
        View::share('productPerCategoryMenuHeader', $productPerCategoryMenuHeader);
    }

}

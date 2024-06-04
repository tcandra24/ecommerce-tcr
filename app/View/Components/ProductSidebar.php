<?php

namespace App\View\Components;

use Illuminate\View\Component;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ProductSidebar extends Component
{
    public $latestProducts;
    public $categories;
    public $brands;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->categories = Category::withCount('products')->get();
        $this->brands = Brand::withCount('products')->get();
        $this->latestProducts = Product::with(['images', 'category'])->where('is_active', true)->latest()->take(3)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.product-sidebar');
    }
}

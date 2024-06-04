<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Category;

class ProductsPerCategoryHeaderMobile extends Component
{
    public $productPerCategoryMenuHeaderMobile;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $productPerCategoryMenuHeader = Category::with('products')->take(2)->get();
        $this->productPerCategoryMenuHeaderMobile = $productPerCategoryMenuHeader->map(function($product){
            return $product->setRelation('products', $product->products->take(5));
        });
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.products-per-category-header-mobile');
    }
}

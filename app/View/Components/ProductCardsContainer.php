<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProductCardsContainer extends Component
{
    public $products;
    public $title;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($products, $title = '')
    {
        $this->products = $products;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.product-cards-container');
    }
}

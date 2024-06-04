<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Category;

class CategoriesHeader extends Component
{
    public $categoriesHeader;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->categoriesHeader = Category::take(10)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        return view('components.categories-header');
    }
}

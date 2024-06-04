@foreach ($productPerCategoryMenuHeader as $category)
    <div class="col-lg-4">
        <a href="/categories/{{ $category->slug }}" class="nolink">{{ $category->name }}</a>
        <ul class="submenu">
            @foreach ($category->products as $product)
                <li><a href="/products/{{ $product->slug }}">{{ $product->title }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endforeach

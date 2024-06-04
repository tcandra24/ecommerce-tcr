<ul>
    @foreach ($productPerCategoryMenuHeaderMobile as $category)
        <li>
            <a href="/categories/{{ $category->slug }}" class="nolink">{{ $category->name }}</a>
            <ul>
                @foreach ($category->products as $product)
                    <li><a href="/products/{{ $product->slug }}">{{ $product->title }}</a></li>
                @endforeach
            </ul>
        </li>
    @endforeach
</ul>

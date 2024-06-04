<ul>
    @foreach ($categoriesHeaderMobile as $category)
        <li><a href="/categories/{{ $category->slug }}">{{ $category->name }}</a></li>
    @endforeach
</ul>

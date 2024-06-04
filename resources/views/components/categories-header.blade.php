@foreach ($categoriesHeader as $category)
    <a href="/categories/{{ $category->slug }}">
        {{ $category->name }}
    </a>
@endforeach

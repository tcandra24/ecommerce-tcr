<aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar">
    <div class="sidebar-wrapper">
        <div class="widget">
            <h3 class="widget-title">
                <a data-toggle="collapse" href="#widget-body-1" role="button" aria-expanded="true"
                    aria-controls="widget-body-1">Categories</a>
            </h3>

            <div class="collapse show" id="widget-body-1">
                <div class="widget-body">
                    <ul class="cat-list">
                        @foreach ($categories as $category)
                            <li>
                                <a href="/categories/{{ $category->slug }}">{{ $category->name }}</a><span
                                    class="products-count">({{ $category->products_count }})</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="widget">
            <h3 class="widget-title">
                <a data-toggle="collapse" href="#widget-body-2" role="button" aria-expanded="true"
                    aria-controls="widget-body-2">Brands</a>
            </h3>

            <div class="collapse show" id="widget-body-2">
                <div class="widget-body">
                    <ul class="cat-list">
                        @foreach ($brands as $brand)
                            <li>
                                <a href="/brands/{{ $brand->slug }}">{{ $brand->name }}</a><span
                                    class="products-count">({{ $brand->products_count }})</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="widget">
            <h3 class="widget-title">
                <a data-toggle="collapse" href="#widget-body-3" role="button" aria-expanded="true"
                    aria-controls="widget-body-3">Price</a>
            </h3>

            <div class="collapse show" id="widget-body-3">
                <div class="widget-body pb-0">
                    <form action="#">
                        <div class="price-slider-wrapper">
                            <div id="price-slider"></div>
                        </div>

                        <div class="filter-price-action d-flex align-items-center justify-content-between flex-wrap">
                            <div class="filter-price-text">
                                Price:
                                <span id="filter-price-range"></span>
                            </div>

                            <input id="sliderValueStart" name="price_start" type="hidden" value="">
                            <input id="sliderValueEnd" name="price_end" type="hidden" value="">

                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="widget widget-featured">
            <h3 class="widget-title">Featured</h3>

            <div class="widget-body">
                <div class="owl-carousel widget-featured-products">
                    <div class="featured-col">
                        @foreach ($latestProducts as $product)
                            <div class="product-default left-details product-widget">
                                <figure>
                                    <a href="/products/{{ $product->slug }}">
                                        <img src="{{ $product->images[0]->name }}" width="75" height="75"
                                            alt="{{ $product->slug }}" />
                                    </a>
                                </figure>
                                <div class="product-details">
                                    <h3 class="product-title">
                                        <a href="/products/{{ $product->slug }}">
                                            {{ $product->title }}
                                        </a>
                                    </h3>
                                    <div class="ratings-container">
                                        <div class="product-ratings">
                                            <span class="ratings" style="width:100%"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                    </div>
                                    <div class="price-box">
                                        <span class="product-price">Rp.
                                            {{ moneyFormat($product->price) }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>

<div class="col-lg-9 main-content">
    @if (count($products) > 0)
        @if ($title)
            <h2 class="title title-underline pb-1 appear-animate" data-animation-name="fadeInLeftShorter">
                {{ $title }}
            </h2>
        @else
            @if (request()->q)
                <h2 class="title title-underline pb-1 appear-animate" data-animation-name="fadeInLeftShorter">
                    Search of : {{ request()->q }}
                </h2>
            @endif
        @endif
        <nav class="toolbox sticky-header" data-sticky-options="{'mobile': true}">
            <div class="toolbox-left">
                <a href="#" class="sidebar-toggle">
                    <svg data-name="Layer 3" id="Layer_3" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                        <line x1="15" x2="26" y1="9" y2="9" class="cls-1"></line>
                        <line x1="6" x2="9" y1="9" y2="9" class="cls-1"></line>
                        <line x1="23" x2="26" y1="16" y2="16" class="cls-1"></line>
                        <line x1="6" x2="17" y1="16" y2="16" class="cls-1"></line>
                        <line x1="17" x2="26" y1="23" y2="23" class="cls-1"></line>
                        <line x1="6" x2="11" y1="23" y2="23" class="cls-1"></line>
                        <path d="M14.5,8.92A2.6,2.6,0,0,1,12,11.5,2.6,2.6,0,0,1,9.5,8.92a2.5,2.5,0,0,1,5,0Z"
                            class="cls-2"></path>
                        <path d="M22.5,15.92a2.5,2.5,0,1,1-5,0,2.5,2.5,0,0,1,5,0Z" class="cls-2"></path>
                        <path d="M21,16a1,1,0,1,1-2,0,1,1,0,0,1,2,0Z" class="cls-3"></path>
                        <path d="M16.5,22.92A2.6,2.6,0,0,1,14,25.5a2.6,2.6,0,0,1-2.5-2.58,2.5,2.5,0,0,1,5,0Z"
                            class="cls-2"></path>
                    </svg>
                    <span>Filter</span>
                </a>

                <div class="toolbox-item toolbox-sort">
                    <label>Sort By:</label>

                    <div class="select-custom">
                        <select name="orderby" class="form-control">
                            <option value="menu_order" selected="selected">Default sorting</option>
                            <option value="popularity">Sort by popularity</option>
                            <option value="rating">Sort by average rating</option>
                            <option value="date">Sort by newness</option>
                            <option value="price">Sort by price: low to high</option>
                            <option value="price-desc">Sort by price: high to low</option>
                        </select>
                    </div>
                </div>
            </div>
        </nav>

        <div class="row">
            @foreach ($products as $product)
                <div class="col-6 col-sm-4">
                    <div class="product-default inner-quickview inner-icon">
                        <figure>
                            <a href="/products/{{ $product->slug }}">
                                <img src="{{ $product->images[0]->name }}" width="300" height="300"
                                    alt="{{ $product->slug }}">
                            </a>
                            <div class="btn-icon-group">
                                <button class="btn-icon btn-add-cart product-type-simple"
                                    data-product-slug="{{ $product->slug }}">
                                    <i class="icon-shopping-cart"></i>
                                </button>
                            </div>
                            <a href="/products/quick-view/{{ $product->slug }}" class="btn-quickview"
                                title="Quick View">
                                Quick View
                            </a>
                        </figure>
                        <div class="product-details">
                            <div class="category-wrap">
                                <div class="category-list">
                                    <a
                                        href="/categories/{{ $product->category->slug }}">{{ $product->category->name }}</a>
                                </div>
                                @if (Auth::guard('customer')->check())
                                    <a href="/wishlists"
                                        class="btn-icon-wish {{ $product->wishlist_exists ? 'added-wishlist' : '' }}"
                                        data-product-slug="{{ $product->slug }}"><i class="icon-heart"></i></a>
                                @endif
                            </div>
                            <h3 class="product-title">
                                <a href="/products/{{ $product->slug }}">{{ $product->title }}</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:0%"></span>
                                    <span class="tooltiptext tooltip-top">0</span>
                                </div>
                            </div>
                            <div class="price-box">
                                <span class="product-price">Rp.
                                    {{ moneyFormat($product->price) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <nav class="toolbox toolbox-pagination">
            <div class="toolbox-item toolbox-show"></div>
            {{ $products->withQueryString()->links('layouts.sections.ecommerce.pagination') }}
        </nav>
    @else
        <div class="col-12">
            <div class="alert alert-rounded alert-info">
                <i class="fas fa-info-circle" style="color: #67cce0;"></i>
                <span><strong>Information!</strong> Product Not Found</span>
            </div>
        </div>
    @endif
</div>

@extends('layouts.ecommerce')

@section('title')
    Product {{ $product->title }}
@endsection

@section('scripts')
    <script>
        $('.add-cart').on('click', function() {
            const product_slug = $('#slug-product').val()
            const qty = $('#qty-product').val()

            $.ajax({
                url: '/carts',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
                },
                type: 'POST',
                data: {
                    slug: product_slug,
                    qty,
                },
                beforeSend: function() {
                    $('.add-cart').text('Loading....')
                    $('.add-cart').attr('disabled', true)
                },
                success: function({
                    success,
                    carts,
                    message
                }) {
                    $('.add-cart').text('Add to Cart')
                    $('.add-cart').attr('disabled', false)

                    if (success) {
                        $('.add-cart').hasClass("disabled") ||
                            ($('.add-cart').addClass(
                                    "added-to-cart"
                                ),
                                $('.view-cart').removeClass("d-none"),
                                $('.cart-message').removeClass(
                                    "d-none"
                                ));
                        cart_items = carts
                        renderCart(cart_items)
                    }
                },
                error: function(xhr) {
                    $('.add-cart').text('Add to Cart')
                    $('.add-cart').attr('disabled', false)
                    console.log(xhr)
                }
            })
        })
    </script>
@endsection

@section('main')
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="/products">Products</a></li>
                <li class="breadcrumb-item">
                    <a href="/categories/{{ $product->category->slug }}">{{ $product->category->name }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->title }}</li>
            </ol>
        </nav>

        <div class="product-single-container product-single-default">
            <div class="cart-message d-none">
                <strong class="single-cart-notice">“{{ $product->title }}”</strong>
                <span>has been added to your cart.</span>
            </div>

            <div class="row">
                <div class="col-lg-5 col-md-6 product-single-gallery">
                    <div class="product-slider-container">

                        <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                            @foreach ($product->images as $image)
                                <div class="product-item">
                                    <img class="product-single-image" src="{{ $image->name }}"
                                        data-zoom-image="{{ $image->name }}" width="468" height="468"
                                        alt="{{ $product->slug }}" />
                                </div>
                            @endforeach
                        </div>
                        <span class="prod-full-screen">
                            <i class="icon-plus"></i>
                        </span>
                    </div>

                    <div class="prod-thumbnail owl-dots">
                        @foreach ($product->images as $image)
                            <div class="owl-dot">
                                <img src="{{ $image->name }}" width="110" height="110"
                                    alt="{{ $product->slug }}-thumbnail" />
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-7 col-md-6 product-single-details">
                    <h1 class="product-title">{{ $product->title }}</h1>

                    <div class="ratings-container">
                        <div class="product-ratings">
                            <span class="ratings" style="width:60%"></span>
                            <span class="tooltiptext tooltip-top"></span>
                        </div>

                        <a href="#" class="rating-link">( 1 Reviews )</a>
                    </div>

                    <hr class="short-divider">

                    <div class="price-box">
                        <span class="product-price">Rp. {{ number_format($product->price, 2) }}</span>
                    </div>

                    <ul class="single-info-list">
                        <li>
                            SKU:
                            <strong>{{ $product->sku }}</strong>
                        </li>

                        <li>
                            CATEGORY:
                            <strong>
                                <a href="/categories/{{ $product->category->slug }}"
                                    class="product-category">{{ $product->category->name }}</a>
                            </strong>
                        </li>
                        <li>
                            BRAND:
                            <strong>
                                <a href="/brands/{{ $product->brand->slug }}"
                                    class="product-brand">{{ $product->brand->name }}</a>
                            </strong>
                        </li>

                    </ul>

                    <div class="product-action">

                        <div class="product-single-qty">
                            <input class="horizontal-quantity form-control" id="qty-product" type="text">
                            <input type="hidden" name="slug" id="slug-product" value="{{ $product->slug }}">
                        </div>

                        @if (Auth::guard('customer')->check())
                            <button class="btn btn-dark add-cart mr-2" title="Add to Cart">
                                Add to Cart
                            </button>
                        @else
                            <a href="/login" class="btn btn-dark mr-2" title="Add to Cart">Add to Cart</a>
                        @endif

                        <a href="/carts" class="btn btn-gray view-cart d-none">View cart</a>
                    </div>

                    <hr class="divider mb-0 mt-0">

                    <div class="product-single-share mb-2">
                        <label class="sr-only">Share:</label>

                        <div class="social-icons mr-2">
                            <a href="#" class="social-icon social-facebook icon-facebook" target="_blank"
                                title="Facebook"></a>
                            <a href="#" class="social-icon social-twitter icon-twitter" target="_blank"
                                title="Twitter"></a>
                            <a href="#" class="social-icon social-linkedin fab fa-linkedin-in" target="_blank"
                                title="Linkedin"></a>
                            <a href="#" class="social-icon social-gplus fab fa-google-plus-g" target="_blank"
                                title="Google +"></a>
                            <a href="#" class="social-icon social-mail icon-mail-alt" target="_blank"
                                title="Mail"></a>
                        </div>
                        @if (Auth::guard('customer')->check())
                            <a href="/wishlists"
                                class="btn-icon-wish add-wishlist {{ $onWishlist ? 'added-wishlist' : '' }}"
                                title="Add to Wishlist" data-product-slug="{{ $product->slug }}">
                                <i class="icon-wishlist-2"></i>
                                <span>{{ $onWishlist ? 'Browse Wishlist' : 'Add to Wishlist' }}</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="product-single-tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content"
                        role="tab" aria-controls="product-desc-content" aria-selected="true">Description</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="product-tab-tags" data-toggle="tab" href="#product-tags-content"
                        role="tab" aria-controls="product-tags-content" aria-selected="false">Additional
                        Information</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="product-tab-reviews" data-toggle="tab" href="#product-reviews-content"
                        role="tab" aria-controls="product-reviews-content" aria-selected="false">Reviews (1)</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel"
                    aria-labelledby="product-tab-desc">
                    <div class="product-desc-content">
                        {!! $product->description !!}
                    </div>
                </div>

                <div class="tab-pane fade" id="product-tags-content" role="tabpanel" aria-labelledby="product-tab-tags">
                    <table class="table table-striped mt-2">
                        <tbody>
                            <tr>
                                <th>Weight</th>
                                <td>{{ $product->weight }} gr</td>
                            </tr>
                            <tr>
                                <th>Category</th>
                                <td>{{ $product->category->name }}</td>
                            </tr>
                            <tr>
                                <th>Brand</th>
                                <td>{{ $product->brand->name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="product-reviews-content" role="tabpanel"
                    aria-labelledby="product-tab-reviews">
                    <div class="product-reviews-content">
                        <h3 class="reviews-title">1 review for Men Black Sports Shoes</h3>

                        <div class="comment-list">
                            <div class="comments">
                                <figure class="img-thumbnail">
                                    <img src="{{ asset('assets/ecommerce/images/blog/author.jpg') }}" alt="author"
                                        width="80" height="80">
                                </figure>

                                <div class="comment-block">
                                    <div class="comment-header">
                                        <div class="comment-arrow"></div>

                                        <div class="ratings-container float-sm-right">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:60%"></span>
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                        </div>

                                        <span class="comment-by">
                                            <strong>Joe Doe</strong> – April 12, 2018
                                        </span>
                                    </div>

                                    <div class="comment-content">
                                        <p>Excellent.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (count($relateProduct) > 0)
            <div class="products-section pt-0">
                <h2 class="section-title">Related Products</h2>

                <div class="products-slider owl-carousel owl-theme dots-top dots-small dots-simple">
                    @foreach ($relateProduct as $product)
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
                                <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick
                                    View</a>
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
                                        <span class="ratings" style="width:80%"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                </div>
                                <div class="price-box">
                                    <span class="product-price">Rp.
                                        {{ number_format($product->price, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection

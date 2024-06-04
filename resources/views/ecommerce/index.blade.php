@extends('layouts.ecommerce')

@section('title')
    Homepage
@endsection

@section('scripts')
    {{--  --}}
@endsection

@section('main')
    <div class="intro-slider slide-animate owl-carousel owl-theme show-nav-hover nav-inside nav-big"
        data-owl-options="{ 'loop': false, 'dots': false, 'nav': true }">
        @foreach ($sliders as $slider)
            <div class="banner"
                style="background: url({{ $slider->image }}) rgb(255, 255, 255); min-height: 530px; background-position: center; background-repeat: no-repeat;">
            </div>
        @endforeach
    </div>
    <section class="category-section container">
        <div class="d-lg-flex align-items-center appear-animate" data-animation-name="fadeInLeftShorter">
            <h2 class="title title-underline divider">Categories</h2>
            <a href="/categories" class="sicon-title">VIEW CATEGORIES<i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="owl-carousel owl-theme appear-animate"
            data-owl-options="{
                'loop': false,
                'dots': false,
                'nav': true,
                'responsive': {
                    '0': {
                        'items': 2
                    },
                    '576': {
                        'items': 3
                    },
                    '991': {
                        'items': 4
                    }
                }
            }">
            @foreach ($categories as $category)
                <div class="product-category">
                    <a href="/categories/{{ $category->slug }}">
                        <figure class="category-custom">
                            <img src="{{ $category->image }}" alt="category" width="250" height="250">
                        </figure>
                    </a>
                    <div class="category-content">
                        <h3 class="category-title">{{ $category->name }}</h3>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <section class="product-section1" style="background-color: #f4f4f4;">
        <div class="container">
            <h2 class="title title-underline pb-1 appear-animate" data-animation-name="fadeInLeftShorter">
                Hot Deals
            </h2>
            <div class="owl-carousel owl-theme appear-animate"
                data-owl-options="{
                    'loop': false,
                    'dots': false,
                    'nav': true,
                    'margin': 20,
                    'responsive': {
                        '0': {
                            'items': 2
                        },
                        '576': {
                            'items': 4
                        },
                        '991': {
                            'items': 6
                        }
                    }
                }">
                @foreach ($latestProducts as $product)
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
                                title="Quick View">Quick
                                View</a>
                        </figure>
                        <div class="product-details">
                            <div class="category-wrap">
                                <div class="category-list">
                                    <a href="/categories/{{ $product->category->slug }}">{{ $product->category->name }}</a>
                                </div>
                                @if (Auth::guard('customer')->check())
                                    <a href="/wishlists"
                                        class="btn-icon-wish {{ $product->wishlist_exists ? 'added-wishlist' : '' }}"
                                        title="wishlist" data-product-slug="{{ $product->slug }}"><i
                                            class="icon-heart"></i></a>
                                @endif
                            </div>
                            <h3 class="product-title">
                                <a href="/products/{{ $product->slug }}">{{ $product->title }}</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:0%"></span>
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                            </div>
                            <div class="price-box">
                                <span class="product-price">Rp. {{ number_format($product->price, 2) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="product-section2 container">
        <div class="row">
            <div class="col-md-4 appear-animate" data-animation-name="fadeInLeftShorter">
                <h3 class="custom-title">Special Offers</h3>
                <div class="owl-carousel owl-theme dots-simple">
                    <div class="banner banner1"
                        style="background: url({{ asset('assets/ecommerce/images/special-offer.jpg') }}) #de0027; background-position: center; background-size: cover; background-repeat: no-repeat; min-height: 40.2rem;">
                        <div class="banner-content banner-layer-middle position-absolute">
                            <h3 class="banner-subtitle text-uppercase text-white">
                                Power Tools
                            </h3>
                            <h2 class="banner-title text-uppercase text-white font-weight-bold">
                                Starting<br>At <sup>Rp</sup>{{ number_format(30000) }}<sup>00</sup>
                            </h2>
                            <p class="banner-desc text-white">Start Shopping Right Now</p>
                            <a href="/products" class="btn btn-dark btn-rounded btn-icon-right ls-25" role="button">
                                Shop Now
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 appear-animate" data-animation-name="fadeInLeftShorter" data-animation-delay="200">
                <div class="d-lg-flex align-items-center">
                    <h3 class="custom-title divider">Promo Product</h3>
                    <a href="/products" class="sicon-title">VIEW ALL<i class="fas fa-arrow-right"></i></a>
                </div>
                @foreach ($latestProducts->take(3) as $product)
                    <div class="product-default left-details product-widget">
                        <figure>
                            <a href="/products/{{ $product->slug }}">
                                <img src="{{ $product->images[0]->name }}" width="95" height="95"
                                    alt="{{ $product->slug }}">
                            </a>
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="/categories/{{ $product->category->slug }}">{{ $product->category->name }}</a>
                            </div>
                            <h3 class="product-title">
                                <a href="/products/{{ $product->slug }}">{{ $product->title }}</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:0%"></span>
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                            </div>
                            <div class="price-box">
                                <span class="product-price">Rp. {{ number_format($product->price, 2) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-4 appear-animate" data-animation-name="fadeInLeftShorter" data-animation-delay="400">
                <div class="d-lg-flex align-items-center">
                    <h3 class="custom-title divider">Customer Favorites</h3>
                    <a href="/products" class="sicon-title">VIEW ALL<i class="fas fa-arrow-right"></i></a>
                </div>
                @foreach ($latestProducts->take(3) as $product)
                    <div class="product-default left-details product-widget">
                        <figure>
                            <a href="/products/{{ $product->slug }}">
                                <img src="{{ $product->images[0]->name }}" width="95" height="95"
                                    alt="{{ $product->slug }}">
                            </a>
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="/categories/{{ $product->category->slug }}">{{ $product->category->name }}</a>
                            </div>
                            <h3 class="product-title">
                                <a href="/products/{{ $product->slug }}">{{ $product->title }}</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:0%"></span>
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                            </div>
                            <div class="price-box">
                                <span class="product-price">Rp. {{ number_format($product->price, 2) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="brand-section appear-animate" style="background-color: #f4f4f4;">
        <div class="container">
            <h2 class="title title-underline pb-1 appear-animate" data-animation-name="fadeInLeftShorter">
                Shop By Brand</h2>
            <div class="owl-carousel owl-theme nav-big nav-outer appear-animate"
                data-owl-options="{
                    'loop': false,
                    'dots': false,
                    'nav': true,
                    'margin': 20,
                    'responsive': {
                        '0': {
                            'items': 1
                        },
                        '750': {
                            'items': 2
                        }
                    }
                }">
                @foreach ($productByBrand as $brand)
                    <div class="brand-box">
                        <div class="brand-name">
                            <h3>Shop {{ $brand->name }}:</h3>
                            <img src="{{ $brand->image }}" width="140" height="60" alt="brand" />
                        </div>
                        <div class="shop-products owl-carousel owl-theme dots-simple"
                            data-owl-options="{
                            'loop': false,
                            'dots': true,
                            'nav': false,
                            'items': 2,
                            'margin': 30
                        }">
                            @foreach ($brand->products as $product)
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
                                                    title="wishlist" data-product-slug="{{ $product->slug }}"><i
                                                        class="icon-heart"></i></a>
                                            @endif
                                        </div>
                                        <h3 class="product-title">
                                            <a href="/products/{{ $product->slug }}">{{ $product->title }}</a>
                                        </h3>
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:100%"></span>
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
                @endforeach
            </div>
        </div>
    </section>
    <section class="brand-section">
        <div class="container">
            <div class="d-lg-flex align-items-center appear-animate" data-animation-name="fadeInLeftShorter">
                <h2 class="title title-underline divider">Brands</h2>
                <a href="/brands" class="sicon-title">VIEW BRANDS<i class="fas fa-arrow-right"></i></a>
            </div>

            <div class="brands-slider owl-carousel owl-theme mb-4 appear-animate owl-loaded owl-drag animated fadeIn appear-animation-visible"
                data-owl-options="{
                    'margin': 20,
                    'responsive': {
                        '0': {
                            'items': 2
                        },
                        '576': {
                            'items': 4
                        },
                        '991': {
                            'items': 6
                        }
                    }
                }"
                data-animation-name="fadeIn" data-animation-delay="400" style="animation-duration: 1000ms;">
                <div class="owl-stage-outer owl-height" style="height: 60.6534px;">
                    <div class="owl-stage"
                        style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1241px;">
                        @foreach ($brands as $brand)
                            <div class="owl-item active" style="width: 206.667px;">
                                <a href="/brands/{{ $brand->slug }}">
                                    <img src="{{ $brand->image }}" alt="{{ $brand->slug }}" width="140"
                                        height="60">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="owl-nav disabled"><button type="button" title="nav" role="presentation"
                        class="owl-prev"><i class="icon-left-open-big"></i></button><button type="button"
                        title="nav" role="presentation" class="owl-next"><i class="icon-right-open-big"></i></button>
                </div>
                <div class="owl-dots disabled"></div>
            </div>
        </div>
    </section>
    <section class="call-section appear-animate" style="background-color: #212529;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h4 class="text-white text-uppercase">looking for help to
                        find auto parts?</h4>
                    <h2 class="text-white">Best Auto Parts In Indonesia</h2>
                    <h3>Call Us or Drop Us a Message Through Our Contact Form</h3>
                </div>
                <div class="col-lg-6 call-action">
                    <div class="d-inline-flex align-items-center text-left divider">
                        <i class="icon-phone-1 text-white mr-2"></i>
                        <h6 class="pt-1 line-height-1 text-uppercase text-white">
                            Call us now
                            <a href="tel:#" class="d-block text-white ls-10 pt-2">0852-6000-0816</a>
                        </h6>
                    </div>
                    <a href="/about-us" class="btn btn-borders btn-rounded btn-outline-white ls-25">
                        Send Us a Message
                    </a>
                </div>
            </div>
        </div>
        <svg class="custom-svg-3 appear-animate" data-animation-name="fadeIn" version="1.1"
            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            viewBox="0 0 649 578">
            <path fill="#de0027"
                d="M-225.5,154.7l358.45,456.96c7.71,9.83,21.92,11.54,31.75,3.84l456.96-358.45c9.83-7.71,11.54-21.92,3.84-31.75                                                                                                                                                                                                                              L267.05-231.66c-7.71-9.83-21.92-11.54-31.75-3.84l-456.96,358.45C-231.49,130.66-233.2,144.87-225.5,154.7z">
            </path>
            <path class="appear-animate appear-animate-svg" data-animation-name="customLineAnim"
                data-animation-delay="300" data-animation-duration="5000" fill="none" stroke="#FFF"
                stroke-width="1.5" stroke-miterlimit="10"
                d="M416-21l202.27,292.91c5.42,7.85,3.63,18.59-4.05,24.25L198,603"></path>
        </svg>
    </section>
    <section class="product-section1 recently">
        <div class="container">
            <h2 class="title title-underline pb-1 appear-animate" data-animation-name="fadeInLeftShorter">
                Recently Arrived</h2>
            <div class="owl-carousel owl-theme appear-animate"
                data-owl-options="{
                    'loop': false,
                    'dots': false,
                    'nav': true,
                    'margin': 20,
                    'responsive': {
                        '0': {
                            'items': 2
                        },
                        '576': {
                            'items': 4
                        },
                        '991': {
                            'items': 6
                        }
                    }
                }">
                @foreach ($latestProducts as $product)
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
                                        title="wishlist" data-product-slug="{{ $product->slug }}"><i
                                            class="icon-heart"></i></a>
                                @endif
                            </div>
                            <h3 class="product-title">
                                <a href="/products/{{ $product->slug }}">{{ $product->title }}</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:0%"></span>
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                            </div>
                            <div class="price-box">
                                <span class="product-price">Rp. {{ number_format($product->price, 2) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

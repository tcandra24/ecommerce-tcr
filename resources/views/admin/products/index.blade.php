@extends('layouts.admin')

@section('title')
    Products
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/jquery-ui/jquery-ui.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/jquery-ui/jquery-ui.theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/owl.carousel/assets/owl.carousel.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/owl.carousel/assets/owl.theme.default.css') }}" />
@endsection

@section('scripts')
    <script src="{{ asset('assets/admin/vendor/nanoscroller/nanoscroller.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/jqueryui-touch-punch/jquery.ui.touch-punch.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/owl.carousel/owl.carousel.js') }}"></script>
@endsection

@section('main')
    <div class="row">
        @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error !</strong> {{ Session::get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true"
                    aria-label="Close"></button>
            </div>
        @endif

        @if (Session::has('success'))
            <div class="alert alert-default alert-dismissible fade show" role="alert">
                <strong>Success !</strong>{{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true"
                    aria-label="Close"></button>
            </div>
        @endif
    </div>
    <div class="ecommerce-form-sidebar-overlay-wrapper">
        <div class="ecommerce-form-sidebar-overlay-body">
            <a href="#" class="ecommerce-form-sidebar-overlay-close"><i class="bx bx-x"></i></a>
            <div class="scrollable h-100 loading-overlay-showing" data-plugin-scrollable>
                <div class="loading-overlay">
                    <div class="bounce-loader">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                </div>
                <div class="ecommerce-form-sidebar-overlay-content scrollable-content px-3 pb-3 pt-1"></div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center justify-content-sm-between pt-2">
        <div class="col-sm-auto text-center mb-4 mb-sm-0 mt-2 mt-sm-0">
            <a href="/admin/products/create"
                class="ecommerce-sidebar-link btn btn-primary btn-md font-weight-semibold btn-py-2 px-4">+ Add Product</a>
        </div>
        <div class="col-sm-auto">
            <form action="#" class="search search-style-1 search-style-1-light mx-auto" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" name="product-term" id="product-term"
                        placeholder="Search Product">
                    <button class="btn btn-default" type="submit"><i class="bx bx-search"></i></button>
                </div>
            </form>
        </div>
    </div>
    <div class="row row-gutter-sm mb-5">
        <div class="col-lg-2-5 col-xl-1-5 mb-4 mb-lg-0">
            <div class="filters-sidebar-wrapper bg-light rounded">
                <div class="card card-modern">
                    <div class="card-header">
                        <div class="card-actions">
                            <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                        </div>
                        <h4 class="card-title">CATEGORIES</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list list-unstyled mb-0">
                            @foreach ($categories as $category)
                                <li>
                                    <a href="#">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <hr class="solid opacity-7">
                <div class="card card-modern">
                    <div class="card-header">
                        <div class="card-actions">
                            <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                        </div>
                        <h4 class="card-title">PRICE</h4>
                    </div>
                    <div class="card-body">
                        <div class="slider-range-wrapper">
                            <div class="m-md slider-primary slider-modern" data-plugin-slider
                                data-plugin-options='{ "half_values": true, "values": [ 25, 270 ], "range": true, "max": 300 }'
                                data-plugin-slider-output="#priceRange"
                                data-plugin-slider-link-values-to="#priceRangeValues">
                                <input id="priceRange" type="hidden" value="25, 270" />
                            </div>
                            <form class="d-flex align-items-center justify-content-between mb-2" method="get">
                                <span id="priceRangeValues" class="price-range-values">
                                    Price $<span class="min price-range-low">25</span> - $<span
                                        class="max price-range-high">270</span>
                                </span>
                                <input type="hidden" class="hidden-price-range-low" name="priceLow" value="" />
                                <input type="hidden" class="hidden-price-range-high" name="priceHigh" value="" />
                                <button type="submit"
                                    class="btn btn-primary btn-h-1 font-weight-semibold rounded-0 btn-px-3 btn-py-1 text-2">FILTER</button>
                            </form>
                        </div>
                    </div>
                </div>
                <hr class="solid opacity-7">
                <div class="card card-modern">
                    <div class="card-header">
                        <div class="card-actions">
                            <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                        </div>
                        <h4 class="card-title">BRANDS</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list list-unstyled mb-0">
                            @foreach ($brands as $brand)
                                <li><a href="#">{{ $brand->name }} <span
                                            class="float-end">{{ $brand->products_count }}</span></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3-5 col-xl-4-5">
            @if (count($products) > 0)
                <div class="row row-gutter-sm">
                    @foreach ($products as $product)
                        <div class="col-sm-6 col-xl-3 mb-4">
                            <div class="card card-modern card-modern-alt-padding">
                                <div class="card-body bg-light">
                                    <div class="image-frame mb-2">
                                        <div class="image-frame-wrapper">
                                            <div class="image-frame-badges-wrapper" style="z-index: 99;">
                                                @if ($product->is_active)
                                                    <span class="badge badge-ecommerce badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-ecommerce badge-danger">Not Active</span>
                                                @endif
                                            </div>
                                            <a href="/admin/products/{{ $product->id }}/edit">
                                                <div class="owl-carousel owl-theme" data-plugin-carousel
                                                    data-plugin-options='{ "dots": false, "nav": true, "items": 1 }'>
                                                    @foreach ($product->images as $image)
                                                        <div class="item">
                                                            <img class="img-thumbnail" src="{{ $image->name }}"
                                                                alt="{{ $image->name }}">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <small>
                                        <a href="#"
                                            class="ecommerce-sidebar-link text-color-grey text-color-hover-primary text-decoration-none">{{ $product->category->name }}</a>
                                    </small>
                                    <h4 class="text-4 line-height-2 mt-0 mb-2">
                                        <a href="/admin/products/{{ $product->id }}/edit"
                                            class="ecommerce-sidebar-link text-color-dark text-color-hover-primary text-decoration-none">
                                            {{ $product->title }}
                                        </a>
                                    </h4>
                                    <div class="stars-wrapper">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div class="product-price">
                                        <div class="sale-price">Rp. {{ number_format($product->price, 2) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row row-gutter-sm justify-content-between">
                    {{ $products->links() }}
                </div>
            @else
                <div class="alert alert-info alert-dismissible fade show text-center" role="alert">
                    <strong>Products </strong> is empty
                </div>
            @endif
        </div>
    </div>
@endsection

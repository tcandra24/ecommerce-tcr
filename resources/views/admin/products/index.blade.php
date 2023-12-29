@extends('layouts.admin')

@section('title')
    Products
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/jquery-ui/jquery-ui.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/jquery-ui/jquery-ui.theme.css') }}" />
@endsection

@section('scripts')
    <script src="{{ asset('assets/admin/vendor/nanoscroller/nanoscroller.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/jqueryui-touch-punch/jquery.ui.touch-punch.js') }}"></script>
@endsection

@section('main')
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
            <div class="row row-gutter-sm">
                <div class="col-sm-6 col-xl-3 mb-4">
                    <div class="card card-modern card-modern-alt-padding">
                        <div class="card-body bg-light">
                            <div class="image-frame mb-2">
                                <div class="image-frame-wrapper">
                                    <div class="image-frame-badges-wrapper">
                                        <span class="badge badge-ecommerce badge-danger">27% OFF</span>
                                    </div>
                                    <a href="ecommerce-products-form.html"><img src="img/products/product-1.jpg"
                                            class="img-fluid" alt="Product Short Name" /></a>
                                </div>
                            </div>
                            <small><a href="ecommerce-products-form.html"
                                    class="ecommerce-sidebar-link text-color-grey text-color-hover-primary text-decoration-none">CATEGORY</a></small>
                            <h4 class="text-4 line-height-2 mt-0 mb-2"><a href="ecommerce-products-form.html"
                                    class="ecommerce-sidebar-link text-color-dark text-color-hover-primary text-decoration-none">Product
                                    Short Name</a></h4>
                            <div class="stars-wrapper">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="product-price">
                                <div class="regular-price on-sale">$59.00</div>
                                <div class="sale-price">$49.00</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-gutter-sm justify-content-between">
                <div class="col-lg-auto order-2 order-lg-1">
                    <p class="text-center text-lg-left mb-0">Showing 1-8 of 60 results</p>
                </div>
                <div class="col-lg-auto order-1 order-lg-2 mb-3 mb-lg-0">
                    <nav aria-label="Page navigation example">
                        <ul
                            class="pagination pagination-modern pagination-modern-spacing justify-content-center justify-content-lg-start mb-0">
                            <li class="page-item">
                                <a class="page-link prev" href="#" aria-label="Previous">
                                    <span><i class="fas fa-chevron-left" aria-label="Previous"></i></span>
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#" disabled="true">...</a></li>
                            <li class="page-item"><a class="page-link" href="#">15</a></li>
                            <li class="page-item">
                                <a class="page-link next" href="#" aria-label="Next">
                                    <span><i class="fas fa-chevron-right" aria-label="Next"></i></span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
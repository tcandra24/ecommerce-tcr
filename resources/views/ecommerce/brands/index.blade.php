@extends('layouts.ecommerce')

@section('title')
    Brands
@endsection

@section('scripts')
    <script src="{{ asset('assets/ecommerce/js/nouislider.min.js') }}"></script>
@endsection

@section('main')
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/"><i class="icon-home"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Brands</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-12 main-content">
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
                    @foreach ($brands as $brand)
                        <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                            <div class="product-default inner-quickview inner-icon">
                                <figure>
                                    <a href="/brands/{{ $brand->slug }}" style="width: 80% !important;">
                                        <img src="{{ $brand->image }}" width="300" height="300"
                                            alt="{{ $brand->slug }}">
                                    </a>
                                </figure>
                            </div>
                        </div>
                    @endforeach

                </div>
                <nav class="toolbox toolbox-pagination">
                    <div class="toolbox-item toolbox-show"></div>
                    <!-- End .toolbox-item -->
                    {{ $brands->links('layouts.sections.ecommerce.pagination') }}
                </nav>
            </div>
        </div>
    </div>

    <div class="mb-4"></div>
@endsection

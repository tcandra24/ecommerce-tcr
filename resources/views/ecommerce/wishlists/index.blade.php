@extends('layouts.ecommerce')

@section('title')
    Wishlists
@endsection

@section('scripts')
    {{--  --}}
@endsection

@section('main')
    <main class="main">
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <div class="container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Wishlist
                            </li>
                        </ol>
                    </div>
                </nav>

                <h1>Wishlist</h1>
            </div>
        </div>

        <div class="container">
            <div class="wishlist-title">
                <h2 class="p-2">My wishlist on Porto Shop 4</h2>
            </div>
            <div class="wishlist-table-container">
                <table class="table table-wishlist mb-0">
                    <thead>
                        <tr>
                            <th class="thumbnail-col"></th>
                            <th class="product-col">Product</th>
                            <th class="price-col">Price</th>
                            <th class="status-col">Stock Status</th>
                            <th class="action-col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($wishlists) > 0)
                            @foreach ($wishlists as $wishlist)
                                <tr class="product-row">
                                    <td>
                                        <figure class="product-image-container">
                                            <a href="/products/{{ $wishlist->product->slug }}" class="product-image">
                                                <img src="{{ $wishlist->product->images[0]->name }}"
                                                    alt="{{ $wishlist->product->slug }}">
                                            </a>

                                            <a href="#" class="btn-remove icon-cancel" title="Remove Product"></a>
                                        </figure>
                                    </td>
                                    <td>
                                        <h5 class="product-title">
                                            <a
                                                href="/products/{{ $wishlist->product->slug }}">{{ $wishlist->product->title }}</a>
                                        </h5>
                                    </td>
                                    <td class="price-box">Rp. {{ number_format($wishlist->product->price, 2) }}</td>
                                    <td>
                                        <span class="stock-status">In stock</span>
                                    </td>
                                    <td class="action">
                                        <a href="/products/{{ $wishlist->product->slug }}"
                                            class="btn btn-quickview mt-1 mt-md-0" title="View Product">VIEW PRODUCT</a>
                                        <button class="btn btn-dark btn-add-cart product-type-simple btn-shop">
                                            ADD TO CART
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">
                                    <div class="alert alert-rounded alert-info">
                                        <i class="fas fa-info-circle" style="color: #67cce0;"></i>
                                        <span><strong>Information!</strong> Wishlist is Empty</span>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection

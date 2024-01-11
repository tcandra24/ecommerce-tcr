@extends('layouts.ecommerce')

@section('title')
    Carts
@endsection

@section('scripts')
    <script>
        $('.btn-remove-cart').on('click', function() {
            const slug = $(this).attr('data-product-slug')
            console.log(slug)
        })
    </script>
@endsection

@section('main')
    <div class="container">
        <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
            <li class="active">
                <a href="/carts">Shopping Cart</a>
            </li>
            <li>
                <a href="/checkout">Checkout</a>
            </li>
            <li class="disabled">
                <a href="javascript:void(0)">Order Complete</a>
            </li>
        </ul>

        <div class="row">
            <div class="col-lg-8">
                @if (count($carts) > 0)
                    <div class="cart-table-container">
                        <table class="table table-cart">
                            <thead>
                                <tr>
                                    <th class="thumbnail-col"></th>
                                    <th class="product-col">Product</th>
                                    <th class="price-col">Price</th>
                                    <th class="qty-col">Quantity</th>
                                    <th class="text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $cart)
                                    <tr class="product-row" id="product-slug-{{ $cart->product->slug }}">
                                        <td>
                                            <figure class="product-image-container">
                                                <a href="/products/{{ $cart->product->slug }}" class="product-image">
                                                    <img src="{{ $cart->product->images[0]->name }}"
                                                        alt="{{ $cart->product->slug }}">
                                                </a>

                                                <a href="javascript:void(0)" data-product-slug="{{ $cart->product->slug }}"
                                                    class="btn-remove btn-remove-cart icon-cancel"
                                                    title="Remove Product"></a>
                                            </figure>
                                        </td>
                                        <td class="product-col">
                                            <h5 class="product-title">
                                                <a
                                                    href="/products/{{ $cart->product->slug }}">{{ $cart->product->title }}</a>
                                            </h5>
                                        </td>
                                        <td>Rp. {{ number_format($cart->product->price, 2) }}</td>
                                        <td>
                                            <div class="product-single-qty">
                                                <input class="horizontal-quantity form-control" type="text"
                                                    value="{{ $cart->qty }}">
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <span class="subtotal-price">Rp.
                                                {{ number_format($cart->total, 2) }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- End .cart-table-container -->
                @else
                    <div class="alert alert-rounded alert-info">
                        <i class="fas fa-info-circle" style="color: #67cce0;"></i>
                        <span><strong>Information!</strong> Cart is Empty</span>
                    </div>
                @endif
            </div><!-- End .col-lg-8 -->

            <div class="col-lg-4">
                <div class="cart-summary">
                    <h3>CART TOTALS</h3>

                    <table class="table table-totals">
                        <tbody>
                            <tr>
                                <td>Total</td>
                                <td>Rp. {{ number_format($carts->sum('total'), 2) }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="checkout-methods">
                        <a href="cart.html" class="btn btn-block btn-dark">Proceed to Checkout
                            <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div><!-- End .cart-summary -->
            </div><!-- End .col-lg-4 -->
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-6"></div>
@endsection

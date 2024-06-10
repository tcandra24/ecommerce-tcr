@extends('layouts.ecommerce')

@section('title')
    Carts
@endsection

@section('scripts')
    <script src="{{ asset('assets/ecommerce/vendor/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        $('.btn-remove-cart').on('click', function() {
            const slug = $(this).attr('data-product-slug')
            const name = $(this).attr('data-product-name')

            Swal.fire({
                title: "Are you Sure ?",
                text: 'Delete ' + name,
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#ccc",
                confirmButtonText: "Yes",
                closeOnConfirm: !1
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteCartRow(slug)
                }
            })
        })

        $('.qty-carts').on('change', function() {
            const qty = $(this).val()
            const slug = $(this).attr('data-slug-product')

            // const {
            //     qty: qtyCart
            // } = cart_items.find(element => element.product.slug === slug)

            // const method = qty > qtyCart ? 'increment' : 'decrement';
            updateCartRow(qty, slug)
        })

        function deleteCartRow(slug) {
            $.ajax({
                url: `/carts/${slug}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
                },
                type: 'DELETE',
                success: function({
                    success,
                    carts
                }) {
                    if (success) {
                        cart_items = carts
                        renderCart(cart_items)

                        $(`#product-slug-${slug}`).remove()
                        if (carts.length === 0) {
                            $('#cart-total-container').remove()
                            $('#container-table-cart').removeClass('col-lg-8')
                            $('#container-table-cart').addClass('col-lg-12')
                            $('.table-cart tbody').html(`
                                <tr>
                                    <td colspan="5">
                                        <div class="alert alert-rounded alert-info justify-content-center">
                                            <i class="fas fa-info-circle" style="color: #67cce0;"></i>
                                            <span><strong>Information!</strong> Cart is Empty</span>
                                        </div>
                                    </td>
                                </tr>
                            `)
                        }
                    }
                },
                error: function({
                    success,
                    message
                }) {
                    console.log(message)
                }
            })
        }

        function updateCartRow(qty, slug) {
            $.ajax({
                url: `/change-carts/${slug}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
                },
                type: 'POST',
                data: {
                    qty
                },
                success: function({
                    success,
                    carts
                }) {
                    if (success) {
                        cart_items = carts
                        renderCart(cart_items)

                        const {
                            total
                        } = cart_items.find(element => element.product.slug === slug)

                        $(`#product-slug-${slug} td:last-child .subtotal-price`).text(
                            `Rp. ${total.toFixed(2).replace(/(\d)(?=(\d{3})+(\.(\d){0,2})*$)/g, '$1,')}`
                        )

                        const total_cart = cart_items.reduce((accumulator, item) => accumulator + item
                            .total,
                            0)

                        $('#grant-total-product').text(
                            `Rp. ${total_cart.toFixed(2).replace(/(\d)(?=(\d{3})+(\.(\d){0,2})*$)/g, '$1,')}`
                        )
                    }
                },
                error: function({
                    success,
                    message
                }) {
                    console.log(message)
                }
            })
        }
    </script>
@endsection

@section('main')
    <div class="container">
        <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
            <li class="active">
                <a href="/carts">Shopping Cart</a>
            </li>
            <li>
                <a href="/checkouts">Checkout</a>
            </li>
            <li class="disabled">
                <a href="javascript:void(0)">Order Complete</a>
            </li>
        </ul>

        <div class="row">
            <div id="container-table-cart" class="{{ count($carts) > 0 ? 'col-lg-8' : 'col-lg-12' }}">
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
                            @if (count($carts) > 0)
                                @foreach ($carts as $cart)
                                    <tr class="product-row" id="product-slug-{{ $cart->product->slug }}">
                                        <td>
                                            <figure class="product-image-container">
                                                <a href="/products/{{ $cart->product->slug }}" class="product-image">
                                                    <img src="{{ $cart->product->images[0]->name }}"
                                                        alt="{{ $cart->product->slug }}">
                                                </a>

                                                <a href="javascript:void(0)" data-product-slug="{{ $cart->product->slug }}"
                                                    data-product-name="{{ $cart->product->title }}"
                                                    class="btn-remove btn-remove-cart icon-cancel"
                                                    title="Remove Product"></a>
                                            </figure>
                                        </td>
                                        <td class="product-col">
                                            <h5 class="product-title">
                                                <a href="/products/{{ $cart->product->slug }}">
                                                    {{ $cart->product->title }}
                                                </a>
                                            </h5>
                                        </td>
                                        <td>Rp. {{ moneyFormat($cart->product->price) }}</td>
                                        <td>
                                            <div class="product-single-qty">
                                                <input class="horizontal-quantity form-control qty-carts" type="text"
                                                    data-slug-product="{{ $cart->product->slug }}"
                                                    value="{{ $cart->qty }}">
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <span class="subtotal-price">Rp.
                                                {{ moneyFormat($cart->total) }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">
                                        <div class="alert alert-rounded alert-info justify-content-center">
                                            <i class="fas fa-info-circle" style="color: #67cce0;"></i>
                                            <span><strong>Information!</strong> Cart is Empty</span>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            @if (count($carts) > 0)
                <div id="cart-total-container" class="col-lg-4">
                    <div class="cart-summary">
                        <h3>CART TOTALS</h3>

                        <table class="table table-totals">
                            <tbody>
                                <tr>
                                    <td>Total</td>
                                    <td id="grant-total-product">Rp. {{ moneyFormat($carts->sum('total')) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="checkout-methods">
                            <a href="/checkouts" class="btn btn-block btn-dark">Proceed to Checkout
                                <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="mb-6"></div>
@endsection

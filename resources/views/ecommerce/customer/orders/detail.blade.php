@extends('layouts.ecommerce')

@section('title')
    My Order
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/ecommerce/vendor/simple-line-icons/css/simple-line-icons.min.css') }}">
@endsection

@section('scripts-head')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-u9b0rGRutsfrJPzV"></script>
@endsection

@section('scripts')
    <script>
        function payment(snap_token) {
            $('.btn-place-order').attr('disabled', true)
            $('#loading-spinner').css('display', 'unset')

            snap.pay(snap_token, {
                onSuccess: function() {
                    $('.btn-place-order').css('display', 'none')
                    location.reload()
                },
                onPending: function() {
                    $('.btn-place-order').css('display', 'none')
                    location.reload()
                },
                onError: function() {
                    $('.btn-place-order').css('display', 'none')
                    location.reload()
                },
                onClose: function() {
                    $('.btn-place-order').attr('disabled', false)
                    $('#loading-spinner').css('display', 'none')
                }
            })

        }
    </script>
@endsection

@section('main')
    <div class="page-header">
        <div class="container d-flex flex-column align-items-center">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            My Order
                        </li>
                    </ol>
                </div>
            </nav>

            <h1>My Order</h1>
        </div>
    </div>

    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/my-account"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $invoice->invoice }}</li>
            </ol>
        </div>
    </nav>

    <div class="container account-container custom-account-container">
        <div class="row">
            <div class="col-lg-7">
                <div class="order-content">
                    <h3 class="account-sub-title d-none d-md-block">
                        <i class="sicon-social-dropbox align-middle mr-3"></i>
                        {{ $invoice->invoice }}
                    </h3>
                    <div class="order-table-container text-center">
                        <table class="table table-order text-left">
                            <thead>
                                <tr>
                                    <th class="order-id">PRODUCT</th>
                                    <th class="order-date">QTY</th>
                                    <th class="order-status">PRICE</th>
                                    <th class="order-price">TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoice->orders as $order)
                                    <tr>
                                        <td>
                                            {{ $order->product->title }}
                                        </td>
                                        <td>
                                            {{ $order->qty }}
                                        </td>
                                        <td>
                                            Rp. {{ moneyFormat($order->price) }}
                                        </td>
                                        <td>
                                            Rp. {{ moneyFormat($order->total) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr class="mt-0 mb-3 pb-2">
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="order-summary">
                    <h3>YOUR DETAILS</h3>

                    <table class="table table-mini-cart">
                        <thead>
                            <tr>
                                <th colspan="2">Customer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="product-col">
                                    <h3 class="product-title">
                                        Name
                                    </h3>
                                </td>

                                <td class="price-col">
                                    <span>{{ $invoice->name }}</span>
                                </td>
                            </tr>

                            <tr>
                                <td class="product-col">
                                    <h3 class="product-title">
                                        Phone
                                    </h3>
                                </td>

                                <td class="price-col">
                                    <span>{{ $invoice->phone }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="product-col">
                                    <h3 class="product-title">
                                        Status Payment
                                    </h3>
                                </td>

                                <td class="price-col">
                                    @if ($invoice->payment_status === 'success')
                                        <span class="badge badge-pill badge-success">Success</span>
                                    @elseif($invoice->payment_status === 'expired')
                                        <span class="badge badge-pill badge-secondary">Expired</span>
                                    @elseif($invoice->payment_status === 'failed')
                                        <span class="badge badge-pill badge-danger">Failed</span>
                                    @else
                                        <span class="badge badge-pill badge-warning">Pending</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="product-col">
                                    <h3 class="product-title">
                                        Status Order
                                    </h3>
                                </td>

                                <td class="price-col">
                                    <span>{{ ucwords(str_replace('_', ' ', $invoice->order_status)) }}</span>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="order-total">
                                <td>
                                    <h4>Total</h4>
                                </td>
                                <td>
                                    <b class="total-price"><span>Rp.
                                            {{ moneyFormat($grandTotal) }}</span></b>
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                    @if ($invoice->payment_status === 'pending')
                        <button onclick="payment('{{ $invoice->snap_token }}')" class="btn btn-dark btn-place-order"
                            form="checkout-form">
                            <svg id="loading-spinner" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"
                                preserveAspectRatio="xMidYMid" width="30" height="30"
                                style="background: rgba(255, 255, 255, 0); display: none;"
                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g>
                                    <circle stroke-dasharray="164.93361431346415 56.97787143782138" r="35" stroke-width="10"
                                        stroke="#959595" fill="none" cy="50" cx="50">
                                        <animateTransform keyTimes="0;1" values="0 50 50;360 50 50" dur="1s"
                                            repeatCount="indefinite" type="rotate" attributeName="transform">
                                        </animateTransform>
                                    </circle>
                                    <g></g>
                                </g>
                            </svg>
                            Pay
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="mb-5"></div>
@endsection

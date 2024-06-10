@extends('layouts.ecommerce')

@section('title')
    My Order
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/ecommerce/vendor/simple-line-icons/css/simple-line-icons.min.css') }}">
@endsection

@section('scripts')
    {{--  --}}
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
                                            Rp. {{ number_format($order->price, 2) }}
                                        </td>
                                        <td>
                                            Rp. {{ number_format($order->total, 2) }}
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
                        </tbody>
                        <tfoot>
                            <tr class="order-total">
                                <td>
                                    <h4>Total</h4>
                                </td>
                                <td>
                                    <b class="total-price"><span>Rp. {{ number_format($grandTotal, 2) }}</span></b>
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                    <button class="btn btn-dark btn-place-order" form="checkout-form">
                        Pay
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-5"></div>
@endsection

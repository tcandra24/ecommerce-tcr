@extends('layouts.ecommerce')

@section('title')
    Checkout
@endsection

@section('styles')
    {{--  --}}
@endsection

@section('scripts')
    {{--  --}}
@endsection

@section('main')
    <div class="container checkout-container">
        <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
            <li>
                <a href="/carts">Shopping Cart</a>
            </li>
            <li class="active">
                <a href="/checkouts">Checkout</a>
            </li>
            <li class="disabled">
                <a href="#">Order Complete</a>
            </li>
        </ul>

        <div class="row">
            <div class="col-lg-6">
                <ul class="checkout-steps">
                    <li>
                        <h2 class="step-title">Shipping details</h2>

                        <form action="/checkouts" method="POST" id="checkout-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="customer-code">Code </label>
                                        <input type="text" class="form-control" id="customer-code"
                                            value="{{ $customer->code }}" name="code" disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="customer-name">Name </label>
                                        <input type="text" class="form-control" id="customer-name" name="name"
                                            value="{{ $customer->name }}" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-2">
                                <label for="customer-company">Company </label>
                                <input type="text" class="form-control" id="customer-company" name="company"
                                    value="{{ $customer->company }}" disabled>
                            </div>

                            <div class="select-custom">
                                <label>Province
                                    <abbr class="required" title="required">*</abbr>
                                </label>
                                <select class="form-control" name="province" required>
                                    <option value="" selected="selected">
                                        Select Province
                                    </option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->province_id }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="select-custom">
                                <label>City
                                    <abbr class="required" title="required" required>*</abbr>
                                </label>
                                <select class="form-control" name="city">
                                    <option value="" selected="selected">
                                        Select City
                                    </option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->city_id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="customer-code">Email </label>
                                        <input type="text" class="form-control" id="customer-code"
                                            value="{{ $customer->email }}" name="email" disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="customer-phone">Phone </label>
                                        <input type="text" class="form-control" id="customer-phone" name="phone"
                                            value="{{ $customer->phone }}" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-2">
                                <label for="customer-address">Address </label>
                                <textarea class="form-control" name="address" id="customer-address" cols="30" rows="10" disabled>
                                    {{ $customer->address }}
                                </textarea>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>

            <div class="col-lg-6">
                <div class="order-summary">
                    <h3>YOUR ORDER</h3>

                    <table class="table table-mini-cart">
                        <thead>
                            <tr>
                                <th colspan="2">Product</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                                <tr>
                                    <td class="product-col">
                                        <h3 class="product-title">
                                            {{ $cart->product->title }} ×
                                            <span class="product-qty">{{ $cart->qty }}</span>
                                        </h3>
                                    </td>

                                    <td class="price-col">
                                        <span>Rp. {{ moneyFormat($cart->price) }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="order-total">
                                <td>
                                    <h4>Total</h4>
                                </td>
                                <td>
                                    <b class="total-price">
                                        <span>
                                            Rp. {{ moneyFormat($carts->sum('total')) }}
                                        </span>
                                    </b>
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                    <button type="submit" class="btn btn-dark btn-place-order" form="checkout-form">
                        Place order
                    </button>
                </div>
                <!-- End .cart-summary -->
            </div>
            <!-- End .col-lg-4 -->
        </div>
        <!-- End .row -->
    </div>
@endsection

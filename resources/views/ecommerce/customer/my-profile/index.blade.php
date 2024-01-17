@extends('layouts.ecommerce')

@section('title')
    My Profile
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
                            My Account
                        </li>
                    </ol>
                </div>
            </nav>

            <h1>My Account</h1>
        </div>
    </div>
    <div class="container account-container custom-account-container">
        <div class="row">
            <div class="sidebar widget widget-dashboard mb-lg-0 mb-3 col-lg-3 order-0">
                <h2 class="text-uppercase">My Account</h2>
                <ul class="nav nav-tabs list flex-column mb-0" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="dashboard-tab" data-toggle="tab" href="#dashboard" role="tab"
                            aria-controls="dashboard" aria-selected="true">Dashboard</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="order-tab" data-toggle="tab" href="#order" role="tab"
                            aria-controls="order" aria-selected="true">Orders</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab"
                            aria-controls="edit" aria-selected="false">
                            Account details
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/wishlists">Wishlist</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link logout-btn" href="javascript:void(0)">Logout</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-9 order-lg-last order-1 tab-content">
                <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
                    <div class="dashboard-content">
                        <div class="row row-lg">
                            <div class="col-6 col-md-4">
                                <div class="feature-box text-center pb-4">
                                    <a href="#order" class="link-to-tab"><i class="sicon-social-dropbox"></i></a>
                                    <div class="feature-box-content">
                                        <h3>ORDERS</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-md-4">
                                <div class="feature-box text-center pb-4">
                                    <a href="#edit" class="link-to-tab"><i class="icon-user-2"></i></a>
                                    <div class="feature-box-content p-0">
                                        <h3>ACCOUNT DETAILS</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-md-4">
                                <div class="feature-box text-center pb-4">
                                    <a href="wishlist.html"><i class="sicon-heart"></i></a>
                                    <div class="feature-box-content">
                                        <h3>WISHLIST</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-md-4">
                                <div class="feature-box text-center pb-4">
                                    <a href="javascript:void(0)" class="logout-btn">
                                        <i class="sicon-logout"></i>
                                    </a>
                                    <div class="feature-box-content">
                                        <h3>LOGOUT</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="order" role="tabpanel">
                    <div class="order-content">
                        <h3 class="account-sub-title d-none d-md-block"><i
                                class="sicon-social-dropbox align-middle mr-3"></i>Orders</h3>
                        <div class="order-table-container text-center">
                            <table class="table table-order text-left">
                                <thead>
                                    <tr>
                                        <th class="order-id">ORDER</th>
                                        <th class="order-date">DATE</th>
                                        <th class="order-status">STATUS</th>
                                        <th class="order-price">TOTAL</th>
                                        <th class="order-action">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center p-0" colspan="5">
                                            <p class="mb-5 mt-5">
                                                No Order has been made yet.
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr class="mt-0 mb-3 pb-2">

                            <a href="/products" class="btn btn-dark">Go Shop</a>
                        </div>
                    </div>
                </div>


                <div class="tab-pane fade" id="edit" role="tabpanel">
                    <h3 class="account-sub-title d-none d-md-block mt-0 pt-1 ml-1"><i
                            class="icon-user-2 align-middle mr-3 pr-1"></i>Account Details</h3>
                    <div class="account-content">
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

                        <div class="form-group mb-2">
                            <label for="customer-city">City </label>
                            <input type="text" class="form-control" id="customer-city" name="city"
                                value="{{ $customer->city }}" disabled>
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
                        <form action="#">
                            <div class="change-password">
                                <h3 class="text-uppercase mb-2">Password Change</h3>

                                <div class="form-group">
                                    <label for="customer-password">Current Password (leave blank to leave
                                        unchanged)</label>
                                    <input type="password" class="form-control" id="customer-password" name="password">
                                </div>

                                <div class="form-group">
                                    <label for="customer-new-password">New Password (leave blank to leave
                                        unchanged)</label>
                                    <input type="password" class="form-control" id="customer-new-password"
                                        name="new_password">
                                </div>

                                <div class="form-group">
                                    <label for="customer-confirm-new-password">Confirm New Password</label>
                                    <input type="password" class="form-control" id="customer-confirm-new-password"
                                        name="confirm_password">
                                </div>
                            </div>

                            <div class="form-footer mt-3 mb-0">
                                <button type="submit" class="btn btn-dark mr-0">
                                    Save changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-5"></div>
@endsection

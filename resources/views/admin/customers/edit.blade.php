@extends('layouts.admin')

@section('title')
    Edit Customer
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/pnotify/pnotify.custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/select2/css/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/select2-bootstrap-theme/select2-bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/bootstrap-multiselect/css/bootstrap-multiselect.css') }}" />
@endsection

@section('scripts')
    <script src="{{ asset('assets/admin/vendor/select2/js/select2.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/bootstrap-multiselect/js/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/jquery-validation/jquery.validate.js') }}"></script>
    <script>
        (function() {

            'use strict';

            // basic
            $("#form").validate({
                highlight: function(label) {
                    $(label).closest('.form-group').removeClass('has-success').addClass('has-error');
                },
                success: function(label) {
                    $(label).closest('.form-group').removeClass('has-error');
                    label.remove();
                },
                errorPlacement: function(error, element) {
                    var placement = element.closest('.input-group');
                    if (!placement.get(0)) {
                        placement = element;
                    }
                    if (error.text() !== '') {
                        placement.after(error);
                    }
                }
            });

        }).apply(this, [jQuery]);
    </script>
@endsection

@section('main')
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error !</strong> {{ Session::get('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true" aria-label="Close"></button>
        </div>
    @endif
    <form class="ecommerce-form action-buttons-fixed" id="form" action="/admin/customers/{{ $customer->id }}"
        method="POST">
        @method('PATCH')
        @csrf
        <div class="row">
            <div class="col">
                <section class="card card-modern card-big-info">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-2-5 col-xl-1-5">
                                <i class="card-big-info-icon bx bx-box"></i>
                                <h2 class="card-big-info-title">Detail Customer</h2>
                                <p class="card-big-info-desc">Add here the customer description with all details and
                                    necessary
                                    information.</p>
                            </div>
                            <div class="col-lg-3-5 col-xl-4-5">
                                <div class="form-group row pb-4 align-items-center">
                                    <label class="col-lg-5 col-xl-3 control-label text-lg-end mb-0">Code</label>
                                    <div class="col-lg-7 col-xl-6">
                                        <input type="text" class="form-control form-control-modern" name="code"
                                            value="{{ $customer->code }}" required>
                                    </div>
                                </div>

                                <div class="form-group row pb-4 align-items-center">
                                    <label class="col-lg-5 col-xl-3 control-label text-lg-end mb-0">Name</label>
                                    <div class="col-lg-7 col-xl-6">
                                        <input type="text" class="form-control form-control-modern" name="name"
                                            value="{{ $customer->name }}" required>
                                    </div>
                                </div>

                                <div class="form-group row pb-4">
                                    <label
                                        class="col-lg-5 col-xl-3 control-label text-lg-end pt-2 mt-1 mb-0">Company</label>
                                    <div class="col-lg-7 col-xl-6">
                                        <input type="text" class="form-control form-control-modern" name="company"
                                            value="{{ $customer->company }}" required>
                                    </div>
                                </div>

                                <div class="form-group row pb-4">
                                    <label class="col-lg-5 col-xl-3 control-label text-lg-end pt-2 mt-1 mb-0">City</label>
                                    <div class="col-lg-7 col-xl-6">
                                        <input type="text" class="form-control form-control-modern" name="city"
                                            value="{{ $customer->city }}" required>
                                    </div>
                                </div>

                                <div class="form-group row pb-4">
                                    <label class="col-lg-5 col-xl-3 control-label text-lg-end pt-2 mt-1 mb-0">Phone</label>
                                    <div class="col-lg-7 col-xl-6">
                                        <input type="text" class="form-control form-control-modern" name="phone"
                                            value="{{ $customer->phone }}" required>
                                    </div>
                                </div>

                                <div class="form-group row pb-4">
                                    <label
                                        class="col-lg-5 col-xl-3 control-label text-lg-end pt-2 mt-1 mb-0">Address</label>
                                    <div class="col-lg-7 col-xl-6">
                                        <textarea class="form-control form-control-modern" name="address" cols="30" rows="5" required>{{ $customer->address }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <section class="card card-modern card-big-info">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-2-5 col-xl-1-5">
                                <i class='card-big-info-icon bx bx-user-circle'></i>
                                <h2 class="card-big-info-title">Account Customer</h2>
                                <p class="card-big-info-desc">Add here the customer account information.</p>
                            </div>
                            <div class="col-lg-3-5 col-xl-4-5">
                                <div class="form-group row pb-4">
                                    <label class="col-lg-5 col-xl-3 control-label text-lg-end pt-2 mt-1 mb-0">Email</label>
                                    <div class="col-lg-7 col-xl-6">
                                        <input type="email" class="form-control form-control-modern" name="email"
                                            value="{{ $customer->email }}" required>
                                    </div>
                                </div>

                                <div class="form-group row pb-4">
                                    <label
                                        class="col-lg-5 col-xl-3 control-label text-lg-end pt-2 mt-1 mb-0">Password</label>
                                    <div class="col-lg-7 col-xl-6">
                                        <input id="password" type="password" class="form-control form-control-modern"
                                            name="password" value="">
                                    </div>
                                </div>
                                <div class="form-group row pb-4">
                                    <label class="col-lg-5 col-xl-3 control-label text-lg-end pt-2 mt-1 mb-0">Confirm
                                        Password</label>
                                    <div class="col-lg-7 col-xl-6">
                                        <input type="password" equalto="#password"
                                            class="form-control form-control-modern" name="confirm_password"
                                            value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="row action-buttons">
            <div class="col-12 col-md-auto">
                <button type="submit"
                    class="submit-button btn btn-primary btn-px-4 py-3 d-flex align-items-center font-weight-semibold line-height-1"
                    data-loading-text="Loading...">
                    <i class="bx bx-save text-4 me-2"></i> Save User
                </button>
            </div>
            <div class="col-12 col-md-auto px-md-0 mt-3 mt-md-0">
                <a href="/admin/customers"
                    class="cancel-button btn btn-light btn-px-4 py-3 border font-weight-semibold text-color-dark text-3">Cancel</a>
            </div>
        </div>
    </form>
@endsection

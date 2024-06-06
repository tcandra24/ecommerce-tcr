@extends('layouts.ecommerce')

@section('title')
    Login
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
                            Login
                        </li>
                    </ol>
                </div>
            </nav>

            <h1>Login</h1>
        </div>
    </div>
    <div class="container login-container">
        <div class="row">
            <div class="col-lg-4 mx-auto">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading mb-1">
                            <h2 class="title">Login</h2>
                        </div>

                        <form action="/login" method="POST">
                            @csrf
                            @if (Session::has('error'))
                                <div class="alert alert-rounded alert-danger">
                                    <i class="fa fa-exclamation-circle" style="color: #ef8495;"></i>
                                    <span><strong>Error!</strong> {{ Session::get('error') }}</span>
                                </div>
                            @endif
                            <label for="login-email">
                                Username or email address
                                <span class="required">*</span>
                            </label>
                            @error('email')
                                <div class="invalid-text">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="email" name="email"
                                class="form-input form-wide {{ $errors->has('email') ? 'is-invalid-input' : '' }}"
                                id="login-email">

                            <label for="login-password">
                                Password
                                <span class="required">*</span>
                            </label>
                            @error('password')
                                <div class="invalid-text">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="password" name="password"
                                class="form-input form-wide {{ $errors->has('password') ? 'is-invalid-input' : '' }}"
                                id="login-password">

                            <div class="form-footer">
                                <div class="custom-control custom-checkbox mb-0">
                                    <input type="checkbox" name="remember" class="custom-control-input" id="lost-password">
                                    <label class="custom-control-label mb-0" for="lost-password">
                                        Remember me
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-dark btn-md w-100">
                                LOGIN
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

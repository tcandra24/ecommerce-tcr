@extends('layouts.admin.auth.login')

@section('main')
    <form action="/admin/login" method="POST">
        @csrf

        @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error !</strong> {{ Session::get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true" aria-label="Close"></button>
            </div>
        @endif
        <div class="form-group mb-3">
            <label>Email</label>
            <div class="input-group">
                <input name="email" type="email" class="form-control" />
                <span class="input-group-text">
                    <i class="bx bx-user text-4"></i>
                </span>
            </div>
        </div>
        <div class="form-group mb-3">
            <div class="clearfix">
                <label class="float-start">Password</label>
            </div>
            <div class="input-group">
                <input name="password" type="password" class="form-control" />
                <span class="input-group-text">
                    <i class="bx bx-lock text-4"></i>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <div class="checkbox-custom checkbox-default">
                    <input id="RememberMe" name="remember" type="checkbox" />
                    <label for="RememberMe">Remember Me</label>
                </div>
            </div>
            <div class="col-sm-4 text-end">
                <button type="submit" class="btn btn-primary mt-2">
                    Log In
                </button>
            </div>
        </div>
    </form>
@endsection

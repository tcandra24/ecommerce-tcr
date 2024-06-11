@extends('layouts.error')

@section('title')
    Internal Server Error
@endsection

@section('main')
    <div class="main-error mb-3">
        <h2 class="error-code text-dark text-center font-weight-semibold m-0">500 <i class="fas fa-file"></i></h2>
        <p class="error-explanation text-center">Internal Server Error</p>
    </div>
@endsection

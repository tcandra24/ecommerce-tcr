@extends('layouts.error')

@section('title')
    Forbidden
@endsection

@section('main')
    <div class="main-error mb-3">
        <h2 class="error-code text-dark text-center font-weight-semibold m-0">403 <i class="fas fa-file"></i></h2>
        <p class="error-explanation text-center">Forbidden</p>
    </div>
@endsection

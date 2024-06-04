@extends('layouts.ecommerce')

@section('title')
    Products
@endsection

@section('scripts')
    <script src="{{ asset('assets/ecommerce/js/nouislider.min.js') }}"></script>
@endsection

@section('main')
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="/categories">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
            </ol>
        </nav>

        <div class="row">
            <x-product-cards-container :products="$products" :title="$title" />

            <div class="sidebar-overlay"></div>

            <x-product-sidebar />
        </div>
    </div>

    <div class="mb-4"></div>
@endsection

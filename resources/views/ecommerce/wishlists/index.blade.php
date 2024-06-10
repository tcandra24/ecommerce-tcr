@extends('layouts.ecommerce')

@section('title')
    Wishlists
@endsection

@section('scripts')
    <script src="{{ asset('assets/ecommerce/vendor/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        $('.btn-remove').on('click', function() {
            const slug = $(this).attr('data-product-slug')
            const name = $(this).attr('data-product-name')

            Swal.fire({
                title: "Are you Sure ?",
                text: 'Delete ' + name,
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#ccc",
                confirmButtonText: "Yes",
                closeOnConfirm: !1
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteWishlistRow(slug)
                }
            })
        })

        function deleteWishlistRow(slug) {
            $.ajax({
                url: `/wishlists/${slug}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
                },
                type: 'DELETE',
                success: function({
                    success,
                    wishlists
                }) {
                    if (success) {
                        $(`#product-slug-${slug}`).remove()
                        if (parseInt(wishlists) === 0) {
                            $('.table-wishlist tbody').html(`
                                <tr>
                                    <td colspan="5">
                                        <div class="alert alert-rounded alert-info justify-content-center">
                                            <i class="fas fa-info-circle" style="color: #67cce0;"></i>
                                            <span><strong>Information!</strong> Wishlist is Empty</span>
                                        </div>
                                    </td>
                                </tr>
                            `)
                        }
                    }
                },
                error: function({
                    success,
                    message
                }) {
                    console.log(message)
                }
            })
        }
    </script>
@endsection

@section('main')
    <main class="main">
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <div class="container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Wishlist
                            </li>
                        </ol>
                    </div>
                </nav>

                <h1>Wishlist</h1>
            </div>
        </div>

        <div class="container">
            <div class="wishlist-title">
                <h2 class="p-2">My wishlist</h2>
            </div>
            <div class="wishlist-table-container">
                <table class="table table-wishlist mb-0">
                    <thead>
                        <tr>
                            <th class="thumbnail-col"></th>
                            <th class="product-col">Product</th>
                            <th class="price-col">Price</th>
                            <th class="status-col">Stock Status</th>
                            <th class="action-col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($wishlists) > 0)
                            @foreach ($wishlists as $wishlist)
                                <tr class="product-row" id="product-slug-{{ $wishlist->product->slug }}">
                                    <td>
                                        <figure class="product-image-container">
                                            <a href="/products/{{ $wishlist->product->slug }}" class="product-image">
                                                <img src="{{ $wishlist->product->images[0]->name }}"
                                                    alt="{{ $wishlist->product->slug }}">
                                            </a>

                                            <a href="javascript:void(0)" class="btn-remove icon-cancel"
                                                title="Remove Product" data-product-slug="{{ $wishlist->product->slug }}"
                                                data-product-name="{{ $wishlist->product->title }}"></a>
                                        </figure>
                                    </td>
                                    <td>
                                        <h5 class="product-title">
                                            <a
                                                href="/products/{{ $wishlist->product->slug }}">{{ $wishlist->product->title }}</a>
                                        </h5>
                                    </td>
                                    <td class="price-box">Rp. {{ moneyFormat($wishlist->product->price) }}</td>
                                    <td>
                                        <span class="stock-status">In stock</span>
                                    </td>
                                    <td class="action">
                                        <a href="/products/{{ $wishlist->product->slug }}" class="btn mt-1 mt-md-0"
                                            title="View Product">VIEW PRODUCT</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">
                                    <div class="alert alert-rounded alert-info justify-content-center">
                                        <i class="fas fa-info-circle" style="color: #67cce0;"></i>
                                        <span><strong>Information!</strong> Wishlist is Empty</span>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection

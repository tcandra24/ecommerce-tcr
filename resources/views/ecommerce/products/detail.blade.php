@extends('layouts.ecommerce')

@section('title')
    Product {{ $product->title }}
@endsection

@section('main')
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="/products">Products</a></li>
                <li class="breadcrumb-item"><a
                        href="/categories/{{ $product->category->slug }}">{{ $product->category->name }}</a></li>
                <li class="breadcrumb-item active">{{ $product->title }}</li>
            </ol>
        </nav>

        <div class="product-single-container product-single-default">
            <div class="cart-message d-none">
                <strong class="single-cart-notice">“{{ $product->title }}”</strong>
                <span>has been added to your cart.</span>
            </div>

            <div class="row">
                <div class="col-lg-5 col-md-6 product-single-gallery">
                    <div class="product-slider-container">

                        <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                            @foreach ($product->images as $image)
                                <div class="product-item">
                                    <img class="product-single-image" src="{{ $image->name }}"
                                        data-zoom-image="{{ $image->name }}" width="468" height="468"
                                        alt="{{ $product->slug }}" />
                                </div>
                            @endforeach
                        </div>
                        <span class="prod-full-screen">
                            <i class="icon-plus"></i>
                        </span>
                    </div>

                    <div class="prod-thumbnail owl-dots">
                        @foreach ($product->images as $image)
                            <div class="owl-dot">
                                <img src="{{ $image->name }}" width="110" height="110"
                                    alt="{{ $product->slug }}-thumbnail" />
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-7 col-md-6 product-single-details">
                    <h1 class="product-title">{{ $product->title }}</h1>

                    <div class="ratings-container">
                        <div class="product-ratings">
                            <span class="ratings" style="width:60%"></span>
                            <span class="tooltiptext tooltip-top"></span>
                        </div>

                        <a href="#" class="rating-link">( 1 Reviews )</a>
                    </div>

                    <hr class="short-divider">

                    <div class="price-box">
                        <span class="product-price">Rp. {{ number_format($product->price, 2) }}</span>
                    </div>

                    <ul class="single-info-list">
                        <li>
                            SKU:
                            <strong>{{ $product->sku }}</strong>
                        </li>

                        <li>
                            CATEGORY:
                            <strong>
                                <a href="#" class="product-category">{{ $product->category->name }}</a>
                            </strong>
                        </li>
                        <li>
                            BRAND:
                            <strong>
                                <a href="#" class="product-brand">{{ $product->brand->name }}</a>
                            </strong>
                        </li>

                    </ul>

                    <div class="product-action">

                        <div class="product-single-qty">
                            <input class="horizontal-quantity form-control" type="text">
                        </div>

                        <a href="javascript:;" class="btn btn-dark add-cart mr-2" title="Add to Cart">Add to
                            Cart</a>

                        <a href="#" class="btn btn-gray view-cart d-none">View cart</a>
                    </div>

                    <hr class="divider mb-0 mt-0">

                    <div class="product-single-share mb-2">
                        <label class="sr-only">Share:</label>

                        <div class="social-icons mr-2">
                            <a href="#" class="social-icon social-facebook icon-facebook" target="_blank"
                                title="Facebook"></a>
                            <a href="#" class="social-icon social-twitter icon-twitter" target="_blank"
                                title="Twitter"></a>
                            <a href="#" class="social-icon social-linkedin fab fa-linkedin-in" target="_blank"
                                title="Linkedin"></a>
                            <a href="#" class="social-icon social-gplus fab fa-google-plus-g" target="_blank"
                                title="Google +"></a>
                            <a href="#" class="social-icon social-mail icon-mail-alt" target="_blank"
                                title="Mail"></a>
                        </div>

                        <a href="wishlist.html" class="btn-icon-wish add-wishlist" title="Add to Wishlist"><i
                                class="icon-wishlist-2"></i><span>Add to
                                Wishlist</span></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="product-single-tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content"
                        role="tab" aria-controls="product-desc-content" aria-selected="true">Description</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="product-tab-tags" data-toggle="tab" href="#product-tags-content"
                        role="tab" aria-controls="product-tags-content" aria-selected="false">Additional
                        Information</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="product-tab-reviews" data-toggle="tab" href="#product-reviews-content"
                        role="tab" aria-controls="product-reviews-content" aria-selected="false">Reviews (1)</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel"
                    aria-labelledby="product-tab-desc">
                    <div class="product-desc-content">
                        {!! $product->description !!}
                    </div>
                </div>

                <div class="tab-pane fade" id="product-tags-content" role="tabpanel" aria-labelledby="product-tab-tags">
                    <table class="table table-striped mt-2">
                        <tbody>
                            <tr>
                                <th>Weight</th>
                                <td>{{ $product->weight }} gr</td>
                            </tr>
                            <tr>
                                <th>Category</th>
                                <td>{{ $product->category->name }}</td>
                            </tr>
                            <tr>
                                <th>Brand</th>
                                <td>{{ $product->brand->name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="product-reviews-content" role="tabpanel"
                    aria-labelledby="product-tab-reviews">
                    <div class="product-reviews-content">
                        <h3 class="reviews-title">1 review for Men Black Sports Shoes</h3>

                        <div class="comment-list">
                            <div class="comments">
                                <figure class="img-thumbnail">
                                    <img src="{{ asset('assets/ecommerce/images/blog/author.jpg') }}" alt="author"
                                        width="80" height="80">
                                </figure>

                                <div class="comment-block">
                                    <div class="comment-header">
                                        <div class="comment-arrow"></div>

                                        <div class="ratings-container float-sm-right">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:60%"></span>
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                        </div>

                                        <span class="comment-by">
                                            <strong>Joe Doe</strong> – April 12, 2018
                                        </span>
                                    </div>

                                    <div class="comment-content">
                                        <p>Excellent.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="divider"></div>

                        <div class="add-product-review">
                            <h3 class="review-title">Add a review</h3>

                            <form action="#" class="comment-form m-0">
                                <div class="rating-form">
                                    <label for="rating">Your rating <span class="required">*</span></label>
                                    <span class="rating-stars">
                                        <a class="star-1" href="#">1</a>
                                        <a class="star-2" href="#">2</a>
                                        <a class="star-3" href="#">3</a>
                                        <a class="star-4" href="#">4</a>
                                        <a class="star-5" href="#">5</a>
                                    </span>

                                    <select name="rating" id="rating" required="" style="display: none;">
                                        <option value="">Rate…</option>
                                        <option value="5">Perfect</option>
                                        <option value="4">Good</option>
                                        <option value="3">Average</option>
                                        <option value="2">Not that bad</option>
                                        <option value="1">Very poor</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Your review <span class="required">*</span></label>
                                    <textarea cols="5" rows="6" class="form-control form-control-sm"></textarea>
                                </div>


                                <div class="row">
                                    <div class="col-md-6 col-xl-12">
                                        <div class="form-group">
                                            <label>Name <span class="required">*</span></label>
                                            <input type="text" class="form-control form-control-sm" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-xl-12">
                                        <div class="form-group">
                                            <label>Email <span class="required">*</span></label>
                                            <input type="text" class="form-control form-control-sm" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="save-name" />
                                            <label class="custom-control-label mb-0" for="save-name">Save my
                                                name, email, and website in this browser for the next time I
                                                comment.</label>
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-primary" value="Submit">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="products-section pt-0">
            <h2 class="section-title">Related Products</h2>

            <div class="products-slider owl-carousel owl-theme dots-top dots-small dots-simple">
                @foreach ($relateProduct as $product)
                    <div class="product-default inner-quickview inner-icon">
                        <figure>
                            <a href="/products/{{ $product->slug }}">
                                <img src="{{ $product->images[0]->name }}" width="300" height="300"
                                    alt="{{ $product->slug }}">
                            </a>
                            <div class="btn-icon-group">
                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                        class="icon-shopping-cart"></i></a>
                            </div>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick
                                View</a>
                        </figure>
                        <div class="product-details">
                            <div class="category-wrap">
                                <div class="category-list">
                                    <a href="#">{{ $product->category->name }}</a>
                                </div>
                                <a href="wishlist.html" class="btn-icon-wish"><i class="icon-heart"></i></a>
                            </div>
                            <h3 class="product-title">
                                <a href="/products/{{ $product->slug }}">{{ $product->title }}</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span>
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                            </div>
                            <div class="price-box">
                                <span class="product-price">Rp. {{ number_format($product->price, 2) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

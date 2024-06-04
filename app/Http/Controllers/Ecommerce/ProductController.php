<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Product;
// use App\Models\Category;
// use App\Models\Brand;
use App\Models\Wishlist;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('images', 'category')->where('is_active', true)
        ->when(request()->q, function($products){
            $products = $products->where('title', 'like', '%' . request()->q . '%');
        })
        ->when(request()->price_start || request()->price_end, function($products){
            $products = $products->whereBetween('price', [request()->price_start, request()->price_end]);
        })->withExists(['wishlist' => function($query){
            $query->where('customer_id', Auth::guard('customer')->user()->id ?? null);
        }])->paginate(9);

        return view('ecommerce.products.index', [
            'products' => $products,
        ]);
    }

    public function detail($slug)
    {
        $product = Product::with('images', 'category')->where('slug', $slug)->first();
        $onWishlist = Wishlist::where('customer_id', Auth::guard('customer')->user()->id ?? null)->where('product_id', $product->id)->exists();

        $relateProduct = Product::with('images', 'category')->withExists(['wishlist' => function($query){
            $query->where('customer_id', Auth::guard('customer')->user()->id ?? null);
        }])->where('is_active', true)->where('category_id', $product->category_id)->where('slug', '<>', $slug)->get();

        return view('ecommerce.products.detail', [
            'product' => $product,
            'relateProduct' => $relateProduct,
            'onWishlist' => $onWishlist,
        ]);
    }

    public function quickView($slug)
    {
        $product = Product::with('images', 'category')->where('slug', $slug)->first();
        $onWishlist = Wishlist::where('customer_id', Auth::guard('customer')->user()->id ?? null)->where('product_id', $product->id)->exists();

        $imageProduct = '';
        $imageThumbnail = '';
        foreach($product->images as $image){
            $imageProduct .= '
            <div class="product-item">
                <img class="product-single-image" src="' . $image->name . '"
                    data-zoom-image="' . $image->name . '" alt="' . $product->slug . '" />
            </div>';

            $imageThumbnail .= '
            <div class="owl-dot">
                <img src="' . $image->name . '" />
            </div>';
        }

        $wishlistTitle = $onWishlist ? 'Browse Wishlist' : 'Add to Wishlist';
        $wishlistClass = $onWishlist ? 'added-wishlist' : '';

        $btnAddToCart = '';
        $componentWishlist = '';
        if(Auth::guard('customer')->check()){
            $btnAddToCart = '
            <button class="btn btn-dark add-cart mr-2" title="Add to Cart">
                Add to Cart
            </button>';
            $componentWishlist = '<a href="/wishlists" class="btn-icon-wish add-wishlist '. $wishlistClass .' " title="Add to Wishlist" data-product-slug="'. $product->slug .'">
            <i class="icon-wishlist-2"></i>
            <span>' . $wishlistTitle . '</span>
        </a>';
        } else {
            $btnAddToCart = '<a href="/login" class="btn btn-dark mr-2" title="Add to Cart">Add to Cart</a>';
        }


        $template = '
        <div class="product-single-container product-single-default product-quick-view mb-0 custom-scrollbar">
            <div class="row">
                <div class="col-md-6 product-single-gallery mb-md-0">
                    <div class="product-slider-container">
                        <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                            '. $imageProduct .'
                        </div>
                    </div>
                    <div class="prod-thumbnail owl-dots">
                        '. $imageThumbnail .'
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="product-single-details mb-0 ml-md-4">
                        <h1 class="product-title">' . $product->title . '</h1>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:60%"></span>
                            </div>

                            <a href="#" class="rating-link">( 6 Reviews )</a>
                        </div>

                        <hr class="short-divider">

                        <div class="price-box">
                            <span class="product-price">Rp.'. number_format($product->price, 2) .'</span>
                        </div>

                        <div class="product-desc">
                            '. html_entity_decode($product->description) .'
                        </div>

                        <ul class="single-info-list">
                            <li>
                                SKU:
                                <strong>'. $product->sku .'</strong>
                            </li>

                            <li>
                                CATEGORY:
                                <strong>
                                    <a href="/categories/'. $product->category->slug .'" class="product-category">'. $product->category->name .'</a>
                                </strong>
                            </li>
                            <li>
                                BRAND:
                                <strong>
                                    <a href="/brands/'. $product->brand->slug .'" class="product-brand">'. $product->brand->name. '</a>
                                </strong>
                            </li>
                        </ul>


                        <div class="product-action">
                            <div class="product-single-qty">
                                <input class="horizontal-quantity form-control" id="qty-product" type="text" />
                                <input type="hidden" name="slug" id="slug-product" value="'. $product->slug .'">
                            </div>

                            '. $btnAddToCart .'

                            <a href="/carts" class="btn view-cart d-none">View cart</a>
                        </div>

                        <hr class="divider mb-0 mt-0">

                        <div class="product-single-share mb-0">
                            <label class="sr-only">Share:</label>

                            <div class="social-icons mr-2">
                                <a href="#" class="social-icon social-facebook icon-facebook" target="_blank"
                                    title="Facebook"></a>
                                <a href="#" class="social-icon social-twitter icon-twitter" target="_blank" title="Twitter"></a>
                                <a href="#" class="social-icon social-linkedin fab fa-linkedin-in" target="_blank"
                                    title="Linkedin"></a>
                                <a href="#" class="social-icon social-gplus fab fa-google-plus-g" target="_blank"
                                    title="Google +"></a>
                                <a href="#" class="social-icon social-mail icon-mail-alt" target="_blank" title="Mail"></a>
                            </div>

                            '. $componentWishlist .'
                        </div>
                    </div>
                </div>

                <button title="Close (Esc)" type="button" class="mfp-close">
                    ×
                </button>
            </div>
        </div>

        <script>
        $(".add-cart").on("click", function() {
            const product_slug = $("#slug-product").val()
            const qty = $("#qty-product").val()

            addToCart(product_slug, qty)
        })
        </script>
        ';

        return $template;
    }
}

<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->group(function() {
    Route::group(['middleware' => ['guest:admin']], function () {
        Route::get('/', function(){
          return redirect('/admin/login');
        });
        Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'index']);
        Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login']);
    });

    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('/dashboard', [ App\Http\Controllers\Admin\DashboardController::class, 'index' , ['as' => 'admin'] ]);

        Route::resource('/categories', App\Http\Controllers\Admin\CategoryController::class, [ 'except' => [ 'show' ]])
        ->middleware('permission:master.categories.index|master.categories.create|master.categories.edit|master.categories.delete');

        Route::resource('/brands', App\Http\Controllers\Admin\BrandsController::class, [ 'except' => [ 'show' ]])
        ->middleware('permission:master.brands.index|master.brands.create|master.brands.edit|master.brands.delete');

        Route::resource('/products', App\Http\Controllers\Admin\ProductController::class, [ 'except' => [ 'show' ]])
        ->middleware('permission:master.products.index|master.products.create|master.products.edit|master.products.delete');

        Route::resource('/sliders', App\Http\Controllers\Admin\SliderController::class, [ 'except' => [ 'show' ]])
        ->middleware('permission:master.sliders.index|master.sliders.create|master.sliders.edit|master.sliders.delete');

        Route::resource('/invoices', App\Http\Controllers\Admin\InvoiceController::class, [ 'only' => [ 'index', 'show' ]])
        ->middleware('permission:transaction.invoices.index|transaction.invoices.show');

        Route::resource('/users', App\Http\Controllers\Admin\UserController::class, [ 'except' => [ 'show' ]])
        ->middleware('permission:setting.users.index|setting.users.create|setting.users.edit|setting.users.delete');

        Route::resource('/roles', App\Http\Controllers\Admin\RoleController::class, [ 'except' => [ 'show' ] ])
        ->middleware('permission:setting.roles.index|setting.roles.create|setting.roles.edit');

        Route::get('/permissions', [ App\Http\Controllers\Admin\PermissionController::class, 'index', ['as' => 'admin'] ])
        ->middleware('permission:setting.permissions.index');

        Route::post('/upload/image', [App\Http\Controllers\Admin\DropzoneController::class, 'upload', ['as' => 'admin']]);
        Route::delete('/delete/image', [App\Http\Controllers\Admin\DropzoneController::class, 'remove', ['as' => 'admin']]);

        Route::post('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout']);
    });
});

Route::get('/', [ App\Http\Controllers\Ecommerce\HomeController::class, 'index' ]);
Route::group(['middleware' => ['guest:customer']], function () {
    Route::get('/login', [App\Http\Controllers\Ecommerce\AuthController::class, 'index']);
    Route::post('/login', [App\Http\Controllers\Ecommerce\AuthController::class, 'login']);
});

Route::group(['middleware' => ['auth:customer']], function () {
    Route::get('/carts', [App\Http\Controllers\Ecommerce\CartController::class, 'index']);
    Route::get('/cart-simple', [App\Http\Controllers\Ecommerce\CartController::class, 'getSimpleCartData']);
    Route::post('/change-carts/{slug}', [App\Http\Controllers\Ecommerce\CartController::class, 'changeCart']);
    Route::post('/carts', [App\Http\Controllers\Ecommerce\CartController::class, 'store']);
    Route::delete('/carts/{slug}', [App\Http\Controllers\Ecommerce\CartController::class, 'destroy']);

    Route::get('/wishlists', [App\Http\Controllers\Ecommerce\WishlistController::class, 'index']);
    Route::post('/wishlists', [App\Http\Controllers\Ecommerce\WishlistController::class, 'store']);
    Route::delete('/wishlists/{slug}', [App\Http\Controllers\Ecommerce\WishlistController::class, 'destroy']);

    Route::get('/checkouts', [App\Http\Controllers\Ecommerce\CheckoutController::class, 'index']);
    Route::post('/checkouts', [App\Http\Controllers\Ecommerce\CheckoutController::class, 'store']);

    Route::prefix('my-account')->group(function() {
        Route::get('/', [App\Http\Controllers\Ecommerce\CustomerController::class, 'profile']);
    });

    Route::post('/logout', [App\Http\Controllers\Ecommerce\AuthController::class, 'logout']);
});

Route::prefix('products')->group(function() {
    Route::get('/', [App\Http\Controllers\Ecommerce\ProductController::class, 'index']);
    Route::get('/{slug}', [App\Http\Controllers\Ecommerce\ProductController::class, 'detail']);
});

Route::prefix('categories')->group(function() {
    Route::get('/', [App\Http\Controllers\Ecommerce\CategoryController::class, 'index']);
    Route::get('/{slug}', [App\Http\Controllers\Ecommerce\CategoryController::class, 'detail']);
});

Route::prefix('brands')->group(function() {
    Route::get('/', [App\Http\Controllers\Ecommerce\BrandController::class, 'index']);
    Route::get('/{slug}', [App\Http\Controllers\Ecommerce\BrandController::class, 'detail']);
});

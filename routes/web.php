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
    Route::get('/', [ App\Http\Controllers\Admin\DashboardController::class, 'index' , ['as' => 'admin'] ]);

    Route::resource('/categories', App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('/brands', App\Http\Controllers\Admin\BrandsController::class);

    Route::post('/upload/image', [App\Http\Controllers\Admin\DropzoneController::class, 'upload', ['as' => 'admin']]);
    Route::delete('/delete/image', [App\Http\Controllers\Admin\DropzoneController::class, 'remove', ['as' => 'admin']]);
});

Route::get('/', [ App\Http\Controllers\Ecommerce\HomeController::class, 'index' ]);

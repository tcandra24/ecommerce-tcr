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
    Route::group(['middleware' => ['guest']], function () {
        Route::get('/', function(){
          return redirect('/admin/login');
        });
        Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'index']);
        Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login']);
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/dashboard', [ App\Http\Controllers\Admin\DashboardController::class, 'index' , ['as' => 'admin'] ]);

        Route::resource('/categories', App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('/brands', App\Http\Controllers\Admin\BrandsController::class);

        Route::post('/upload/image', [App\Http\Controllers\Admin\DropzoneController::class, 'upload', ['as' => 'admin']]);
        Route::delete('/delete/image', [App\Http\Controllers\Admin\DropzoneController::class, 'remove', ['as' => 'admin']]);

        Route::post('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout']);
    });
});

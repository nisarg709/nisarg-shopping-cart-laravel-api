
<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::post('/login', [UsersController::class, 'login']);

Route::get('/category', [CategoryController::class, 'categories']);
Route::get('/sub-category/{id?}', [CategoryController::class, 'subCategories']);

Route::post('/uploads', [ProductsController::class, 'upload']);

Route::middleware(['auth:api'])->group(function () {

    Route::get('/my-orders', [OrderController::class, 'myOrders']);
    Route::get('/my-cart', [OrderController::class, 'myCarts']);
    Route::post('/update-cart', [OrderController::class, 'updateCart']);

    Route::delete('/remove-cart/{id}', [OrderController::class, 'removeCarts']);

    Route::post('/order', [OrderController::class, 'createOrder']);
    Route::get('/checkout', [OrderController::class, 'checkout']);

    Route::get('/products', [ProductsController::class, 'products']);
    Route::get('/product-detail/{id}', [ProductsController::class, 'productDetail']);
    Route::post('/product/{id?}', [ProductsController::class, 'addEditProduct']);
    Route::delete('/product/{id}', [ProductsController::class, 'productDelete']);

});

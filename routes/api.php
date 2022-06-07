<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::namespace('API\Auth')->group(function () {
// Route::post('login', 'UserController@login');
// Route::post('register', 'UserController@register');
Route::post('refreshtoken', 'UserController@refreshToken');

//     Route::group(['middleware' => ['auth:api']], function () {
//         Route::post('logout', 'UserController@logout');
//         Route::post('details', 'UserController@details');
//     });
});
Route::namespace('API\Auth')->group(function () {
//prefix: api/app/v1/
    Route::post('login', 'LoginController@login')->name('login');
    
    Route::post('register', 'RegisterController@register')->name('register');
    

    Route::group(['middleware' => ['auth:api']], function () {

        Route::get('email/verify', 'VerificationController@show')->name('api.user.verification.notice');

        Route::post('email/verify', 'VerificationController@verify')->name('api.user.verification.verify');

        Route::get('email/resend', 'VerificationController@resend')->name('api.user.verification.resend');

        Route::get('user', 'AuthenticationController@user')->name('user');

        Route::post('logout', 'LoginController@logout')->name('logout');

        Route::post('address','AddressController@store')->name('store');
        Route::post('address/default',['as'=>'address.default','uses'=>'AddressController@defaultAddress']);
        Route::get('/address',['as'=>'address','uses'=>'AddressController@index']);
        Route::post('address/edit',['as'=>'address.edit','uses'=>'AddressController@edit']);
        Route::delete('/address',['as'=>'address.delete','uses'=>'AddressController@delete']);
        
        
    });
});

Route::namespace('API')->group(function () {

    Route::get('/categories',['as'=>'categories.index','uses'=>'CategoryController@index']);
        Route::get('/category/{slug}/products',['as'=>'category.products','uses'=>'CategoryController@products']);
        Route::get('/products',['as'=>'products','uses'=>'ProductController@index']);
        Route::get('/product/{:slug}/show',['as'=>'product.show','uses'=>'ProductController@show']);
        Route::post('/cart', ['as'=>'cart.add','uses'=>'CartController@addToCart']);
        Route::post('/getcart', ['as'=>'cart.get','uses'=>'CartController@getCart']);
        Route::delete('/cart/{id}',['as'=>'cart.delete','uses'=>'CartController@delete']);
        Route::delete('/cart',['as'=>'cart.items.delete','uses'=>'CartController@destroy']);
        Route::post('/cart/update',['as'=>'cart.update','uses'=>'CartController@cartUpdate']);
        Route::middleware('auth:api')->post('/checkout',['as'=>'checkout','uses'=>'CheckoutController@checkout']);
        Route::middleware('auth:api')->post('/orders',['as'=>'orders','uses'=>'OrderController@orders']);

        Route::middleware('auth:api')->post('/product/orders',['as'=>'product.orders','uses'=>'OrderController@productOrders']);
});


// Route::get('/carts', function() {
//     $cart =  Session::put('nadme','kaisir');
//     return response()->json($cart);

// });

// Route::get('/get-content', function() {
//     dd(Session::get('nadme'));
// });



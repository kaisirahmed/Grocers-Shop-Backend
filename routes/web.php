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

Auth::routes([ 'verify' => true ]);

Route::namespace('Admin')->group(function(){

	Route::prefix('admin')->name('admin.')->namespace('Auth')->group(function(){
			 
        Route::post('/logout',['as'=>'logout','uses'=>'LoginController@logout']);

		Route::get('/login', ['as'=>'login','uses'=>'LoginController@showLoginForm']);

		Route::post('/login', ['as'=>'login','uses'=>'LoginController@login']);

        //Forgot Password Routes
        Route::get('/password/reset',['as'=>'password.request','uses'=>'ForgotPasswordController@showLinkRequestForm']);

        Route::post('/password/email',['as'=>'password.email','uses'=>'ForgotPasswordController@sendResetLinkEmail']);

        //Reset Password Routes
        Route::get('/password/reset/{token}',['as'=>'password.reset','uses'=>'ResetPasswordController@showResetForm']);

        Route::post('/password/reset',['as'=>'password.update','uses'=>'ResetPasswordController@reset']);

        // Email Verification Route(s)
        Route::get('/email/verify',['as'=>'verification.notice','uses'=>'VerificationController@show']);

        Route::get('/email/verify/{id}',['as'=>'verification.verify','uses'=>'VerificationController@verify']);

        Route::get('/email/resend',['as'=>'verification.resend','uses'=>'VerificationController@resend']);
	});

	Route::group(['middleware' => ['auth:admin','guard.verified:admin,admin.verification.notice']], function () {

		Route::prefix('admin')->name('admin.')->namespace('Auth')->group(function(){

			Route::get('/register', ['as'=>'register','uses'=>'RegisterController@showRegistrationForm']);

			Route::post('/register', ['as'=>'register','uses'=>'RegisterController@create']);
		});
	

		Route::prefix('admin')->name('admin.')->group(function() {
			Route::resource('/','AdminController');
			Route::get('/{admin}/edit',['as'=>'edit','uses'=>'AdminController@edit']);
			Route::post('/update/{admin}',['as'=>'update','uses'=>'AdminController@update']);
			Route::delete('/{admin}',['as'=>'destroy','uses'=>'AdminController@destroy']);

			Route::get('dashboard',['as'=>'dashboard','uses'=>'AdminController@admin']);
			Route::get('/permissions',['as'=>'permissions.index','uses'=>'PermissionController@index']);
			Route::get('/permissions/{adminId}/edit',['as'=>'permissions.edit','uses'=>'PermissionController@edit']);
			Route::post('/permissions/{adminId}',['as'=>'permissions.update','uses'=>'PermissionController@update']);
			Route::delete('/permissions/{permissions}',['as'=>'permissions.destroy','uses'=>'PermissionController@destroy']);

			Route::get('/staff/permissions',['as'=>'staff.permissions.index','uses'=>'PermissionController@staffIndex']);
			Route::get('/staff/permissions/{staffId}/edit',['as'=>'staff.permissions.edit','uses'=>'PermissionController@staffEdit']);
			Route::post('/staff/permissions/{staffId}',['as'=>'staff.permissions.update','uses'=>'PermissionController@staffUpdate']);
			Route::delete('/staff/permissions/{permissions}',['as'=>'staff.permissions.staffDestroy','uses'=>'PermissionController@staffDestroy']);
		});
		
	});
});

Route::namespace('System')->group(function(){
	Route::group(['middleware' => ['auth:admin','guard.verified:admin,admin.verification.notice']], function () {
		Route::prefix('admin')->name('admin.')->group(function() {
			Route::resource('system','SystemController');
		});
	});
});

Route::namespace('Unit')->group(function(){
	Route::group(['middleware' => ['auth:admin','guard.verified:admin,admin.verification.notice']], function () {
		Route::resource('product/unit','UnitController');
	});
});

Route::namespace('Category')->group(function(){
	Route::group(['middleware' => ['can:view','auth:admin,staff']], function () {
		Route::resource('category','CategoryController');
		Route::get('/categories/pdf',['as'=>'categories.pdf','uses'=>'CategoryController@pdf']);
	});
});

Route::namespace('Product')->group(function(){
	Route::group(['middleware' => ['can:view','auth:admin,staff']], function () {
		Route::resource('product','ProductController');
		Route::post('products/delete',['as'=>'products.delete','uses'=>'ProductController@delete']);
		Route::get('/products/pdf',['as'=>'products.pdf','uses'=>'ProductController@pdf']);
	});
});

Route::namespace('Stock')->group(function(){
	Route::group(['middleware' => ['can:view','auth:admin,staff']], function () {
		Route::resource('stock','StockController');
		Route::get('/stocks/pdf',['as'=>'stocks.pdf','uses'=>'StockController@pdf']);
		Route::post('/stock/product/unit',['as'=>'stock.product.unit','uses'=>'StockController@productUnit']);
	});
});

Route::namespace('Order')->group(function(){
	Route::group(['middleware' => ['can:view','auth:admin,staff']], function () {
		
		Route::get('/order/{id}/invoice',['as'=>'order.invoice','uses'=>'OrderController@invoice']);
		Route::resource('order','OrderController');
		//Route::post('/stock/product/unit',['as'=>'stock.product.unit','uses'=>'StockController@productUnit']);
	});
});

Route::namespace('CMS')->group(function(){
	Route::group(['middleware' => ['auth:admin','guard.verified:admin,admin.verification.notice']], function () {
		Route::prefix('admin')->name('admin.')->group(function() {
			Route::get('/cms/pages/pdf',['as'=>'cms.pages.pdf','uses'=>'CmsController@pdf']);
			Route::get('/cms',['as'=>'cms.index','uses'=>'CmsController@index']);
			Route::get('/cms/create',['as'=>'cms.create','uses'=>'CmsController@create']);
			Route::post('/cms',['as'=>'cms.store','uses'=>'CmsController@store']);
			Route::get('/cms/{cms}',['as'=>'cms.show','uses'=>'CmsController@show']);
			Route::get('/cms/{cms}/edit',['as'=>'cms.edit','uses'=>'CmsController@edit']);
			Route::post('/cms/{cms}',['as'=>'cms.update','uses'=>'CmsController@update']);
			Route::delete('/cms/{cms}',['as'=>'cms.destroy','uses'=>'CmsController@destroy']);
		});
	});
});

Route::namespace('Staff')->group(function(){
	Route::group(['middleware' => ['auth:admin','guard.verified:admin,admin.verification.notice']], function () {
		Route::namespace('Auth')->group(function(){
			Route::get('/admin/staff/register', ['as'=>'staff.register','uses'=>'RegisterController@showRegistrationForm']);

			Route::post('/admin/staff/register', ['as'=>'staff.register','uses'=>'RegisterController@create']);
		});
		Route::resource('admin/staff','StaffController');
	});
});

Route::get('/',['as'=>'panel','uses'=>'Panel\PanelController@panel']);

// Route::namespace('API')->group(function(){

// 	Route::post('/api/app/v1/cart', ['as'=>'cart.add','uses'=>'CartController@addToCart']);
//     Route::get('/api/app/v1/cart', ['as'=>'cart.get','uses'=>'CartController@getCart']);
// });
/*=================================================================
**=================================================================
**====================== Staff Routes =============================
**=================================================================
**================================================================*/

Route::namespace('Staff')->group(function(){

	Route::prefix('staff')->name('staff.')->namespace('Auth')->group(function(){
		 
	    Route::post('/logout',['as'=>'logout','uses'=>'LoginController@logout']);

		Route::get('/login', ['as'=>'login','uses'=>'LoginController@showLoginForm']);

		Route::post('/login', ['as'=>'login','uses'=>'LoginController@login']);

	    //Forgot Password Routes
	    Route::get('/password/reset',['as'=>'password.request','uses'=>'ForgotPasswordController@showLinkRequestForm']);

	    Route::post('/password/email',['as'=>'password.email','uses'=>'ForgotPasswordController@sendResetLinkEmail']);

	    //Reset Password Routes
	    Route::get('/password/reset/{token}',['as'=>'password.reset','uses'=>'ResetPasswordController@showResetForm']);

	    Route::post('/password/reset',['as'=>'password.update','uses'=>'ResetPasswordController@reset']);

	    // Email Verification Route(s)
	    Route::get('/email/verify',['as'=>'verification.notice','uses'=>'VerificationController@show']);

	    Route::get('/email/verify/{id}',['as'=>'verification.verify','uses'=>'VerificationController@verify']);

	    Route::get('/email/resend',['as'=>'verification.resend','uses'=>'VerificationController@resend']);
    
	});

	Route::group(['middleware' => ['auth:staff','guard.verified:staff,staff.verification.notice']], function () {
	
		Route::get('/staff',['as'=>'staff','uses'=>'StaffController@staff']);
		
	});
});


Route::fallback(function() {
	return abort(404);
});
 


// Route::get('/visitors', function () {
//     $ip = Request::userAgent();
//     return $ip;
// });

// Route::get('{any}', function () {
//     return view('welcome');
// })->where('any','.*');	
<?php
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
// frontend controller
Route::get('/','HomeController@index');

// admin controller route
Route::get('/admin','AdminController@index');
Route::post('/admin_login','AdminController@admin_login');
Route::get('/admin_dashboard','AdminController@admin_dashboard');
Route::get('/add_user','AdminController@add_user');
Route::post('/save_admin','AdminController@save_admin');
Route::get('/all_user','AdminController@all_user');
Route::get('/edit_user/{admin_id}','AdminController@edit_user');
Route::post('/update_user/{admin_id}','AdminController@update_user');
Route::get('/profile/{admin_id}','AdminController@profile_view');
Route::post('/update_profile/{admin_id}','AdminController@update_profile');
Route::get('/user_password_change/{admin_id}','AdminController@user_password_change');
Route::post('/user_password_update/{admin_id}','AdminController@user_password_update');
Route::get('/delete_admin/{admin_id}','AdminController@delete_admin');
Route::get('/logout','AdminController@logout');


//Category Controller route
Route::get('/add_category','CategoryController@add_category');
Route::post('/save_category','CategoryController@save_category');//insert
Route::get('/all_category','CategoryController@all_category');
Route::get('/unactive_category/{category_id}','CategoryController@unactive_category');
Route::get('/active_category/{category_id}','CategoryController@active_category');
Route::get('/edit_category/{category_id}','CategoryController@edit_category');
Route::post('/update_category/{category_id}','CategoryController@update_category');
Route::get('/delete_category/{category_id}','CategoryController@delete_category');


//brand Controller route
Route::get('/add_brand','BrandController@add_brand');
Route::post('/save_brand','BrandController@save_brand');//insert
Route::get('/all_brand','BrandController@all_brand');
Route::get('/unactive_brand/{brand_id}','BrandController@unactive_brand');
Route::get('/active_brand/{brand_id}','BrandController@active_brand');
Route::get('/edit_brand/{brand_id}','BrandController@edit_brand');
Route::post('/update_brand/{brand_id}','BrandController@update_brand');
Route::get('/delete_brand/{brand_id}','BrandController@delete_brand');


//Product Controller route
Route::get('/add_product','ProductController@add_product');
Route::post('/save_product','ProductController@save_product');
Route::get('/all_product','ProductController@all_product');
Route::get('/unactive_product/{product_id}','ProductController@unactive_product');
Route::get('/active_product/{product_id}','ProductController@active_product');
Route::get('/edit_product/{product_id}','ProductController@edit_product');
Route::post('/update_product/{product_id}','ProductController@update_product');
Route::get('/delete_product/{product_id}','ProductController@delete_product');

//slider routes
Route::get('/add_slider','SliderController@index');
Route::post('/save_slider','SliderController@save_slider');
Route::get('/delete_slider/{slider_id}','SliderController@delete_slider');
Route::get('/all_slider','SliderController@all_slider');
Route::get('/unactive_slider/{product_id}','ProductController@unactive_slider');
Route::get('/active_slider/{product_id}','ProductController@active_slider');


//PayPal
Route::get('paypal/express-checkout/{total}', 'PaypalController@expressCheckout');//->name('paypal.express-checkout');
Route::get('paypal/express-checkout-success', 'PaypalController@expressCheckoutSuccess');
Route::post('paypal/notify', 'PaypalController@notify');


//category wise product
Route::get('/product_by_category/{category_id}','HomeController@show_product_by_category');

//brand wise product
Route::get('/product_by_brand/{brand_id}','HomeController@show_product_by_brand');

//search
Route::get('/search','HomeController@search');
Route::get('/price_range','HomeController@price_range');

//product details
Route::get('/product_details/{product_id}','HomeController@product_details');

// Cart Controller
Route::post('/add_to_cart','CartController@add_to_cart');
Route::get('/show_cart','CartController@show_cart');
Route::get('/delete_to_cart/{rowId}','CartController@delete_to_cart');
Route::post('/update_cart','CartController@update_cart');

//CheckoutController
Route::get('/login_check','CheckoutController@login_check');
Route::post('/customer_registration','CheckoutController@customer_registration');
Route::get('/checkout','CheckoutController@checkout');
Route::post('/save_shipping','CheckoutController@save_shipping');
Route::post('/customer_login','CheckoutController@customer_login');
Route::get('/customer_logout','CheckoutController@customer_logout');
Route::get('/payment','CheckoutController@payment');
Route::post('/order_place','CheckoutController@order_place');
Route::get('/congratulate','CheckoutController@congratulate');

//order controller
Route::get('/manage_order','OrderController@manage_order');
Route::get('/view_pending_order/{customer_id}','OrderController@view_pending_order');
Route::get('/view_done_order/{customer_id}','OrderController@view_done_order');
Route::get('/done_order/{order_id}','OrderController@done_order');
Route::get('/pending_order/{order_id}','OrderController@pending_order');
Route::get('/done_payment/{payment_id}','OrderController@done_payment');
Route::get('/pending_payment/{payment_id}','OrderController@pending_payment');
Route::get('/delete_order/{order_id}','OrderController@delete_order');

//contact controller
Route::get('/contact_form','ContactController@contact_form');
Route::post('/contact_send','ContactController@contact_send');
Route::get('/all_contact','ContactController@all_contact');
Route::get('/seen_contact/{contact_id}','ContactController@seen_contact');
Route::get('/unseen_contact/{contact_id}','ContactController@unseen_contact');
Route::get('/show_contact/{contact_id}','ContactController@show_contact');
Route::get('/reply_contact/{contact_id}','ContactController@reply_contact');
Route::get('/delete_contact/{contact_id}','ContactController@delete_contact');


//webSite controller
Route::get('/edit_site','SiteController@edit_site');
Route::post('/update_site','SiteController@update_site');


Route::get('/reports','AdminController@reports');
Route::get('/inventory','AdminController@inventory');
Route::get('/getdata','AdminController@getdata');
Route::get('/getInventoryData','AdminController@getInventoryData');

Route::get('/pdfview','AdminController@pdfview')->name('pdfview');
Route::get('/pdfviewInventory','AdminController@pdfviewInventory')->name('pdfviewInventory');
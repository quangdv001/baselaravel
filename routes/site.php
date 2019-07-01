<?php
Route::get('register', 'SiteAuthController@getRegister')->name('auth.getRegister');
Route::post('register', 'SiteAuthController@postRegister')->name('auth.postRegister');
Route::get('login', 'SiteAuthController@getLogin')->name('auth.getLogin');
Route::post('login', 'SiteAuthController@postLogin')->name('auth.postLogin');
Route::get('logout', 'SiteAuthController@logout')->name('auth.logout');

Route::get('/', 'SiteHomeController@index')->name('home.index');
Route::post('sendContact', 'SiteHomeController@sendContact')->name('home.sendContact');

Route::get('order', 'SiteHomeController@order')->name('home.order');
Route::get('order/detail', 'SiteHomeController@orderDetail')->name('home.detail');

Route::get('article/i-{id}/{slug}', 'SiteArticleController@index')->name('article.index');
Route::get('article/l-{id}/{slug}', 'SiteArticleController@list')->name('article.list');
Route::get('article/d-{id}/{slug}', 'SiteArticleController@detail')->name('article.detail');

Route::get('product/l-{id}/{slug}', 'SiteProductController@index')->name('product.list');
Route::get('product/detail/{id}', 'SiteProductController@detail')->name('product.detail');

Route::get('cart', 'SiteCartController@index')->name('cart.index');
Route::get('cart/payment', 'SiteCartController@payment')->name('cart.payment');
Route::post('cart/add/{id}', 'SiteCartController@add')->name('cart.add');
Route::post('cart/remove/{rowId}', 'SiteCartController@remove')->name('cart.remove');
Route::post('cart/update/{rowId}/{qty}', 'SiteCartController@update')->name('cart.update');
Route::get('cart/destroy', 'SiteCartController@destroy')->name('cart.destroy');
Route::post('cart/submitOrder', 'SiteCartController@submitOrder')->name('cart.submitOrder');





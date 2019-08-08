<?php
Route::get('register', 'SiteAuthController@getRegister')->name('auth.getRegister');
Route::post('register', 'SiteAuthController@postRegister')->name('auth.postRegister');
Route::get('login', 'SiteAuthController@getLogin')->name('auth.getLogin');
Route::post('login', 'SiteAuthController@postLogin')->name('auth.postLogin');
Route::get('logout', 'SiteAuthController@logout')->name('auth.logout');

Route::get('/', 'SiteHomeController@index')->name('home.index');
Route::get('lang/{locale}', 'SiteHomeController@lang')->name('home.setLocale');
Route::get('currentLang', 'SiteArticleController@currentLang')->name('home.sendContact');
Route::post('sendContact', 'SiteHomeController@sendContact')->name('home.sendContact');
Route::get('booking', 'SiteHomeController@booking')->name('home.booking');
Route::post('booking', 'SiteHomeController@postBooking')->name('home.postBooking');
Route::get('about', 'SiteHomeController@about')->name('home.about');
Route::get('regulations', 'SiteHomeController@regulations')->name('home.regulations');
Route::get('regulations/download/{name}', 'SiteHomeController@downloadFile')->name('home.downloadFile');
Route::get('gastation', 'SiteHomeController@gastation')->name('home.gastation');
Route::get('ticketLocation', 'SiteHomeController@ticketLocation')->name('home.ticketLocation');
Route::get('faqs', 'SiteHomeController@faqs')->name('home.faqs');
Route::get('shipping_policy', 'SiteHomeController@shipping_policy')->name('home.shipping_policy');
Route::get('payment_guide', 'SiteHomeController@payment_guide')->name('home.payment_guide');
Route::get('customer_care', 'SiteHomeController@customer_care')->name('home.customer_care');

Route::get('price', 'SiteArticleController@price')->name('home.price');
Route::get('livitrans', 'SiteArticleController@livitrans')->name('home.livitrans');
Route::get('contact', 'SiteArticleController@contact')->name('home.contact');



Route::get('article/i-{id}/{slug}', 'SiteArticleController@index')->name('article.index');
// Route::get('article/l-{id}/{slug}', 'SiteArticleController@list')->name('article.list');
Route::get('article/d-{id}/{slug}', 'SiteArticleController@detail')->name('article.detail');







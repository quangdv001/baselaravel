<?php
Route::get('register', 'SiteAuthController@getRegister')->name('auth.getRegister');
Route::post('register', 'SiteAuthController@postRegister')->name('auth.postRegister');
Route::get('login', 'SiteAuthController@getLogin')->name('auth.getLogin');
Route::post('login', 'SiteAuthController@postLogin')->name('auth.postLogin');
Route::get('login/google', 'SiteAuthController@loginGoogle')->name('auth.getLoginGG');
Route::get('login/google/callback', 'SiteAuthController@loginGoogleCallback')->name('auth.postLoginGG');
Route::get('login/facebook', 'SiteAuthController@loginFacebook')->name('auth.getLoginFB');
Route::get('login/facebook/callback', 'SiteAuthController@loginFacebookCallback')->name('auth.postLoginFB');
Route::get('logout', 'SiteAuthController@logout')->name('auth.logout');

Route::get('/', 'SiteHomeController@index')->name('home.index');
Route::get('/category/{slug?}', 'SiteHomeController@showCategory')->name('home.category');
Route::get('/posts/{slug?}', 'SiteHomeController@show')->name('home.show');
Route::get('/for-rents/{slug?}', 'SiteHomeController@showForRent')->name('home.showForRent');

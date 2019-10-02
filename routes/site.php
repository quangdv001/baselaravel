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
Route::get('tim-kiem', 'SiteHomeController@search')->name('home.search');
Route::get('dang-tin', 'SiteHomeController@userCreate')->name('home.usercreate')->middleware('auth.site');
Route::post('dang-tin', 'SiteHomeController@userPostCreate')->name('home.userpostcreate')->middleware('auth.site');
Route::get('{slug}', 'SiteHomeController@showList')->name('home.category');
Route::get('{slugCategory}/{slugDetail}', 'SiteHomeController@showDetail')->name('home.showDetail');

Route::get('province/loadProvince/{select?}', 'SiteHomeController@loadProvince')->name('ward.loadProvince');
Route::get('province/loadDistrict/{id}/{select?}', 'SiteHomeController@loadDistrict')->name('ward.loadDistrict');
Route::get('province/loadWard/{id}/{select?}', 'SiteHomeController@loadWard')->name('ward.loadWard');
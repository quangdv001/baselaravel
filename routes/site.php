<?php
Route::get('register', 'SiteAuthController@getRegister')->name('auth.getRegister');
Route::post('register', 'SiteAuthController@postRegister')->name('auth.postRegister');
Route::get('login', 'SiteAuthController@getLogin')->name('auth.getLogin');
Route::post('login', 'SiteAuthController@postLogin')->name('auth.postLogin');
Route::get('logout', 'SiteAuthController@logout')->name('auth.logout');

Route::get('/', 'SiteHomeController@index')->name('home.index');
Route::post('sendContact', 'SiteHomeController@sendContact')->name('home.sendContact');

Route::get('article/l-{id}/{slug}', 'SiteArticleController@index')->name('article.list');
Route::get('article/d-{id}/{slug}', 'SiteArticleController@detail')->name('article.detail');

Route::get('product/l-{id}/{slug}', 'SiteProductController@index')->name('product.list');
Route::get('product/d-{id}/{slug}', 'SiteProductController@detail')->name('product.detail');

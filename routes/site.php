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

Route::get('about', 'SiteArticleController@about')->name('home.about');
Route::get('price', 'SiteArticleController@price')->name('home.price');
Route::get('livitrans', 'SiteArticleController@livitrans')->name('home.livitrans');
Route::get('contact', 'SiteArticleController@contact')->name('home.contact');



Route::get('article/i-{id}/{slug}', 'SiteArticleController@index')->name('article.index');
// Route::get('article/l-{id}/{slug}', 'SiteArticleController@list')->name('article.list');
Route::get('article/d-{id}/{slug}', 'SiteArticleController@detail')->name('article.detail');







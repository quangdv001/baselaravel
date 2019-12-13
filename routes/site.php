<?php
Route::get('register', 'SiteAuthController@getRegister')->name('auth.getRegister');
Route::post('register', 'SiteAuthController@postRegister')->name('auth.postRegister');
Route::get('login', 'SiteAuthController@getLogin')->name('auth.getLogin');
Route::post('login', 'SiteAuthController@postLogin')->name('auth.postLogin');
Route::get('logout', 'SiteAuthController@logout')->name('auth.logout');

Route::get('/', 'SiteHomeController@index')->name('home.index');

Route::get('danh-muc/{slug}-{id}', 'SiteArticleController@index')->name('article.index');
Route::get('bai-viet/{slug}-{id}', 'SiteArticleController@detail')->name('article.detail');






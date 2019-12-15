<?php
Route::get('register', 'SiteAuthController@getRegister')->name('auth.getRegister');
Route::post('register', 'SiteAuthController@postRegister')->name('auth.postRegister');
Route::get('login', 'SiteAuthController@getLogin')->name('auth.getLogin');
Route::post('login', 'SiteAuthController@postLogin')->name('auth.postLogin');
Route::get('logout', 'SiteAuthController@logout')->name('auth.logout');

Route::get('/', 'SiteHomeController@index')->name('home.index');

Route::get('danh-muc/{id}/{slug}', 'SiteArticleController@index')->name('article.index');
Route::get('bai-viet/{id}/{slug}', 'SiteArticleController@detail')->name('article.detail');
Route::get('cho-thue/{id}/{slug}', 'SiteArticleController@detailRoom')->name('room.detail');
Route::get('tim-kiem', 'SiteArticleController@search')->name('article.search');

Route::get('trang/{id}/{slug}', 'SitePageController@index')->name('page.index');






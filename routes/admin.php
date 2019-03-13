<?php

Route::get('admin/login', 'AdminAuthController@getLogin')->name('getLogin')->middleware('guest');
Route::post('admin/login', 'AdminAuthController@postLogin')->name('postLogin');
Route::get('admin/logout', 'AdminAuthController@logout')->name('logout');

Route::middleware(['auth.admin'])->prefix('admin')->group(function () {
    Route::get('/', 'AdminHomeController@index')->name('home.dashboard');
    Route::get('test', 'AdminHomeController@test')->name('home.test');

    Route::get('account', 'AdminAccountController@index')->name('account.getList');
    Route::get('account/getCreate/{id?}', 'AdminAccountController@getCreate')->name('account.getCreate');
    Route::post('account/getCreate/{id?}', 'AdminAccountController@postCreate')->name('account.postCreate');

    Route::get('permission', 'AdminPermissionController@index')->name('permission.getList');
    Route::get('permission/getCreate/{id?}', 'AdminPermissionController@getCreate')->name('permission.getCreate');
    Route::post('permission/getCreate/{id?}', 'AdminPermissionController@postCreate')->name('permission.postCreate');
    Route::post('permission/editPermission', 'AdminPermissionController@editPermission')->name('permission.editPermission');
    Route::post('permission/removePermission', 'AdminPermissionController@removePermission')->name('permission.removePermission');
    Route::get('permission/removeGroup', 'AdminPermissionController@removeGroup')->name('permission.removeGroup');
});


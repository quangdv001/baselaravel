<?php

Route::get('admin/login', 'AdminAuthController@getLogin')->name('getLogin');
Route::post('admin/login', 'AdminAuthController@postLogin')->name('postLogin');
Route::get('admin/logout', 'AdminAuthController@logout')->name('logout');

Route::middleware(['auth.admin'])->prefix('admin')->group(function () {
    Route::get('/', 'AdminHomeController@index')->name('home.dashboard');
    Route::get('test', 'AdminHomeController@test')->name('home.test');
    Route::get('export-pdf', 'AdminHomeController@exportPdf');

    Route::get('account', 'AdminAccountController@index')->name('account.getList');
    Route::get('account/getCreate/{id?}', 'AdminAccountController@getCreate')->name('account.getCreate');
    Route::post('account/getCreate/{id?}', 'AdminAccountController@postCreate')->name('account.postCreate');

    Route::get('permission', 'AdminPermissionController@index')->name('permission.getList');
    Route::get('permission/getCreate/{id?}', 'AdminPermissionController@getCreate')->name('permission.getCreate');
    Route::post('permission/getCreate/{id?}', 'AdminPermissionController@postCreate')->name('permission.postCreate');
    Route::post('permission/editPermission', 'AdminPermissionController@editPermission')->name('permission.editPermission');
    Route::post('permission/removePermission', 'AdminPermissionController@removePermission')->name('permission.removePermission');
    Route::get('permission/removeGroup', 'AdminPermissionController@removeGroup')->name('permission.removeGroup');

    Route::get('category', 'AdminCategoryController@index')->name('category.getList');
    Route::post('category/create', 'AdminCategoryController@create')->name('category.create');
    Route::post('category/update/{id}', 'AdminCategoryController@update')->name('category.update');
    Route::get('category/{id}', 'AdminCategoryController@show')->name('category.show');
    Route::get('category/remove/{id}', 'AdminCategoryController@remove')->name('category.remove');
    Route::post('category/updatePosition', 'AdminCategoryController@updatePosition')->name('category.updatePosition');

    Route::get('province', 'AdminProvinceController@index')->name('province.getList');
    Route::get('province/district', 'AdminProvinceController@listDistrict')->name('district.getList');
    Route::get('province/ward', 'AdminProvinceController@listWard')->name('ward.getList');
    Route::get('province/loadProvince/{select?}', 'AdminProvinceController@loadProvince')->name('ward.loadProvince');
    Route::get('province/loadDistrict/{id}/{select?}', 'AdminProvinceController@loadDistrict')->name('ward.loadDistrict');
    Route::get('province/loadWard/{id}/{select?}', 'AdminProvinceController@loadWard')->name('ward.loadWard');

    Route::get('article/{type}', 'AdminArticleController@index')->name('article.getList');
    Route::get('article/getCreate/{type}/{id?}', 'AdminArticleController@getCreate')->name('article.getCreate');
    Route::post('article/getCreate/{type}/{id?}', 'AdminArticleController@postCreate')->name('article.postCreate');
    Route::get('article/remove/{type}/{id?}', 'AdminArticleController@remove')->name('article.remove');

    Route::get('page', 'AdminPageController@index')->name('page.getList');
    Route::get('page/getCreate/{id?}', 'AdminPageController@getCreate')->name('page.getCreate');
    Route::post('page/getCreate/{id?}', 'AdminPageController@postCreate')->name('page.postCreate');
    Route::get('page/remove/{id?}', 'AdminPageController@remove')->name('page.remove');
    Route::get('page/loadPages/{select?}', 'AdminPageController@loadPages')->name('page.loadProvince');

    Route::get('room', 'AdminRoomController@index')->name('room.getList');
    Route::get('room/getCreate/{id?}', 'AdminRoomController@getCreate')->name('room.getCreate');
    Route::post('room/getCreate/{id?}', 'AdminRoomController@postCreate')->name('room.postCreate');
    Route::get('room/remove/{id?}', 'AdminRoomController@remove')->name('room.remove');

    Route::get('file', 'AdminFileController@index')->name('file.getList');
    Route::post('file/uploadFile', 'AdminFileController@uploadFile')->name('file.uploadFile');
    Route::post('file/removeFile/{id}', 'AdminFileController@removeFile')->name('file.removeFile');
    Route::get('file/downloadFile/{id}', 'AdminFileController@downloadFile')->name('file.downloadFile');
    Route::get('file/openFileModal', 'AdminFileController@openFileModal')->name('file.openFileModal');

    Route::get('user', 'AdminUserController@index')->name('user.getList');
    Route::post('user/updateStatus/{id}', 'AdminUserController@updateStatus')->name('user.updateStatus');

    Route::get('setting-footer', 'AdminSettingFooterController@index')->name('settingFooter.getList');
    Route::get('setting-footer/{id}', 'AdminSettingFooterController@show')->name('settingFooter.show');
    Route::post('setting-footer/create', 'AdminSettingFooterController@create')->name('settingFooter.create');
    Route::post('setting-footer/update/{id}', 'AdminSettingFooterController@update')->name('settingFooter.update');
    Route::post('setting-footer/updatePosition', 'AdminSettingFooterController@updatePosition')->name('settingFooter.updatePosition');
    Route::get('setting-footer/remove/{id?}', 'AdminSettingFooterController@remove')->name('settingFooter.remove');

    Route::get('general-info', 'AdminGeneralInfoController@index')->name('generalInfo.index');
    Route::get('general-info/getCreate/{id?}', 'AdminGeneralInfoController@getCreate')->name('generalInfo.getCreate');
    Route::post('general-info/getCreate/{id?}', 'AdminGeneralInfoController@postCreate')->name('generalInfo.postCreate');
    Route::get('general-info/remove/{id?}', 'AdminGeneralInfoController@remove')->name('generalInfo.remove');

    Route::get('advertise', 'AdminAdvertiseController@index')->name('advertise.getList');
    Route::get('advertise/getCreate/{id?}', 'AdminAdvertiseController@getCreate')->name('advertise.getCreate');
    Route::post('advertise/getCreate/{id?}', 'AdminAdvertiseController@postCreate')->name('advertise.postCreate');
    Route::get('advertise/remove/{id?}', 'AdminAdvertiseController@remove')->name('advertise.remove');

    Route::get('transaction', 'AdminTransactionController@index')->name('transaction.getList');
    Route::post('transaction/getCreate/{id?}', 'AdminTransactionController@postCreate')->name('transaction.postCreate');
});


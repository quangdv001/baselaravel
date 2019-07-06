<?php

Route::get('admin/login', 'AdminAuthController@getLogin')->name('getLogin');
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

    Route::get('article', 'AdminArticleController@index')->name('article.getList');
    Route::get('article/getCreate/{id?}', 'AdminArticleController@getCreate')->name('article.getCreate');
    Route::post('article/getCreate/{id?}', 'AdminArticleController@postCreate')->name('article.postCreate');
    Route::get('article/remove/{id?}', 'AdminArticleController@remove')->name('article.remove');

    Route::get('law', 'AdminLawController@index')->name('law.getList');
    Route::get('law/getCreate/{id?}', 'AdminLawController@getCreate')->name('law.getCreate');
    Route::post('law/getCreate/{id?}', 'AdminLawController@postCreate')->name('law.postCreate');
    Route::get('law/remove/{id?}', 'AdminLawController@remove')->name('law.remove');

    Route::get('project', 'AdminProjectController@index')->name('project.getList');
    Route::get('project/getCreate/{id?}', 'AdminProjectController@getCreate')->name('project.getCreate');
    Route::post('project/getCreate/{id?}', 'AdminProjectController@postCreate')->name('project.postCreate');
    Route::get('project/remove/{id?}', 'AdminProjectController@remove')->name('project.remove');

    Route::get('room', 'AdminRoomController@index')->name('room.getList');
    Route::get('room/getCreate/{id?}', 'AdminRoomController@getCreate')->name('room.getCreate');
    Route::post('room/getCreate/{id?}', 'AdminRoomController@postCreate')->name('room.postCreate');
    Route::get('room/remove/{id?}', 'AdminRoomController@remove')->name('room.remove');

    Route::get('advertise', 'AdminAdvertiseController@index')->name('advertise.getList');
    Route::get('advertise/getCreate/{id?}', 'AdminAdvertiseController@getCreate')->name('advertise.getCreate');
    Route::post('advertise/getCreate/{id?}', 'AdminAdvertiseController@postCreate')->name('advertise.postCreate');
    Route::get('advertise/remove/{id?}', 'AdminAdvertiseController@remove')->name('advertise.remove');

    Route::get('file', 'AdminFileController@index')->name('file.getList');
    Route::post('file/uploadFile', 'AdminFileController@uploadFile')->name('file.uploadFile');
    Route::post('file/removeFile/{id}', 'AdminFileController@removeFile')->name('file.removeFile');
    Route::get('file/downloadFile/{id}', 'AdminFileController@downloadFile')->name('file.downloadFile');
    Route::get('file/openFileModal', 'AdminFileController@openFileModal')->name('file.openFileModal');

    Route::get('footerSocial', 'AdminFooterController@index')->name('footerSocial.getList');
    Route::get('footerSocial/getCreate/{id?}', 'AdminFooterController@getCreate')->name('footerSocial.getCreate');
    Route::post('footerSocial/getCreate/{id?}', 'AdminFooterController@postCreate')->name('footerSocial.postCreate');
    Route::get('footerSocial/remove/{id?}', 'AdminFooterController@remove')->name('footerSocial.remove');

    Route::get('manager', 'AdminManagerController@index')->name('manager.getList');
    Route::get('manager/getCreate/{id?}', 'AdminManagerController@getCreate')->name('manager.getCreate');
    Route::post('manager/getCreate/{id?}', 'AdminManagerController@postCreate')->name('manager.postCreate');
    Route::get('manager/remove/{id?}', 'AdminManagerController@remove')->name('manager.remove');
});


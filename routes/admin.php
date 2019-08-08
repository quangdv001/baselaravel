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

    Route::get('article/{locale?}', 'AdminArticleController@index')->name('article.getList');
    Route::get('article/getCreate/{locale?}/{id?}', 'AdminArticleController@getCreate')->name('article.getCreate');
    Route::post('article/getCreate/{locale?}/{id?}', 'AdminArticleController@postCreate')->name('article.postCreate');
    Route::get('article/remove/{id?}', 'AdminArticleController@remove')->name('article.remove');

    Route::get('room', 'AdminRoomController@index')->name('room.getList');
    Route::get('room/getCreate/{id?}', 'AdminRoomController@getCreate')->name('room.getCreate');
    Route::post('room/getCreate/{id?}', 'AdminRoomController@postCreate')->name('room.postCreate');
    Route::get('room/remove/{id?}', 'AdminRoomController@remove')->name('room.remove');

    Route::get('file', 'AdminFileController@index')->name('file.getList');
    Route::post('file/uploadFile', 'AdminFileController@uploadFile')->name('file.uploadFile');
    Route::post('file/removeFile/{id}', 'AdminFileController@removeFile')->name('file.removeFile');
    Route::get('file/downloadFile/{id}', 'AdminFileController@downloadFile')->name('file.downloadFile');
    Route::get('file/openFileModal', 'AdminFileController@openFileModal')->name('file.openFileModal');

    Route::get('product', 'AdminProductController@index')->name('product.getList');
    Route::get('product/getCreate/{id?}', 'AdminProductController@getCreate')->name('product.getCreate');
    Route::post('product/getCreate/{id?}', 'AdminProductController@postCreate')->name('product.postCreate');
    Route::get('product/remove/{id?}', 'AdminProductController@remove')->name('product.remove');

    Route::get('material', 'AdminMaterialController@index')->name('material.getList');
    Route::get('material/getCreate/{id?}', 'AdminMaterialController@getCreate')->name('material.getCreate');
    Route::post('material/getCreate/{id?}', 'AdminMaterialController@postCreate')->name('material.postCreate');
    Route::get('material/remove/{id?}', 'AdminMaterialController@remove')->name('material.remove');

    Route::get('order', 'AdminOrderController@index')->name('order.getList');
    Route::get('order/{id}', 'AdminOrderController@show')->name('order.show');
    Route::post('order/{id}', 'AdminOrderController@updateStatus')->name('order.updateStatus');
    Route::get('order/remove/{id?}', 'AdminOrderController@remove')->name('order.remove');

    Route::get('user', 'AdminUserController@index')->name('user.getList');
    Route::post('user/updateStatus/{id}', 'AdminUserController@updateStatus')->name('user.updateStatus');

    Route::get('socials', 'AdminSocialsController@index')->name('socials.getList');
    Route::get('socials/getCreate/{id?}', 'AdminSocialsController@getCreate')->name('socials.getCreate');
    Route::post('socials/getCreate/{id?}', 'AdminSocialsController@postCreate')->name('socials.postCreate');

    Route::get('slider', 'AdminSliderController@index')->name('slider.getList');
    Route::get('slider/getCreate/{id?}', 'AdminSliderController@getCreate')->name('slider.getCreate');
    Route::post('slider/getCreate/{id?}', 'AdminSliderController@postCreate')->name('slider.postCreate');
    Route::get('slider/remove/{id?}', 'AdminSliderController@remove')->name('slider.remove');

    Route::get('page', 'AdminPageController@index')->name('page.getList');
    Route::get('page/getCreate/{locale?}/{id?}', 'AdminPageController@getCreate')->name('page.getCreate');
    Route::post('page/getCreate/{locale?}/{id?}', 'AdminPageController@postCreate')->name('page.postCreate');
    Route::get('page/remove/{id?}', 'AdminPageController@remove')->name('page.remove');
});


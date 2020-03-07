<?php
Route::middleware(['auth:web'])->group(function () {
    Route::get('/', 'MyMotelController@index')->name('motel.getList');
    Route::get('motel/getCreate/{id?}', 'MyMotelController@getCreate')->name('motel.getCreate');
    Route::post('motel/getCreate/{id?}', 'MyMotelController@postCreate')->name('motel.postCreate');
    Route::get('motel/remove/{id?}', 'MyMotelController@remove')->name('motel.remove');

    Route::get('room', 'MyMotelRoomController@index')->name('room.getList');
    Route::get('room/getCreate/{id?}', 'MyMotelRoomController@getCreate')->name('room.getCreate');
    Route::post('room/getCreate/{id?}', 'MyMotelRoomController@postCreate')->name('room.postCreate');
    Route::get('room/remove/{id?}', 'MyMotelRoomController@remove')->name('room.remove');

    Route::get('service', 'MyServiceController@index')->name('service.getList');
    Route::get('service/getCreate/{id?}', 'MyServiceController@getCreate')->name('service.getCreate');
    Route::post('service/getCreate/{id?}', 'MyServiceController@postCreate')->name('service.postCreate');
    Route::get('service/remove/{id?}', 'MyServiceController@remove')->name('service.remove');

    Route::get('formula/getCreate/{id?}', 'MyServiceController@getFormula')->name('formula.getCreate');
    Route::post('formula/getCreate/{id?}', 'MyServiceController@postFormula')->name('formula.postCreate');
    Route::get('formula/remove/{id?}', 'MyServiceController@removeFormula')->name('formula.remove');

    Route::get('/customer', 'MyCustomerController@index')->name('customer.getList');
    Route::get('customer/getCreate/{id?}', 'MyCustomerController@getCreate')->name('customer.getCreate');
    Route::post('customer/getCreate/{id?}', 'MyCustomerController@postCreate')->name('customer.postCreate');
    Route::get('customer/remove/{id?}', 'MyCustomerController@remove')->name('customer.remove');
});






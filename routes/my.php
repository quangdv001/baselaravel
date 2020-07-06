<?php
Route::middleware(['auth:web','auth.my'])->group(function () {
    Route::get('/', 'MyMotelController@index')->name('motel.getList');
    Route::get('motel/getCreate/{id?}', 'MyMotelController@getCreate')->name('motel.getCreate');
    Route::post('motel/getCreate/{id?}', 'MyMotelController@postCreate')->name('motel.postCreate');
    Route::get('motel/remove/{id?}', 'MyMotelController@remove')->name('motel.remove');

    Route::get('room', 'MyMotelRoomController@index')->name('room.getList');
    Route::get('room/getCreate/{id?}', 'MyMotelRoomController@getCreate')->name('room.getCreate');
    Route::post('room/getCreate/{id?}', 'MyMotelRoomController@postCreate')->name('room.postCreate');
    Route::get('room/remove/{id?}', 'MyMotelRoomController@remove')->name('room.remove');
    Route::get('room/contract/{id}', 'MyMotelRoomController@editContract')->name('room.editContract');

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

    Route::get('/contract', 'MyContractController@index')->name('contract.getList');
    Route::get('contract/getCreate/{id?}', 'MyContractController@getCreate')->name('contract.getCreate');
    Route::post('contract/getCreate/{id?}', 'MyContractController@postCreate')->name('contract.postCreate');
    Route::get('contract/remove/{id?}', 'MyContractController@remove')->name('contract.remove');
    Route::get('contract/pdf/{id?}', 'MyContractController@pdf')->name('contract.pdf');

    Route::get('/bill', 'MyBillController@index')->name('bill.getList');
    Route::get('bill/getCreate/{id?}', 'MyBillController@getCreate')->name('bill.getCreate');
    Route::post('bill/getCreate/{id?}', 'MyBillController@postCreate')->name('bill.postCreate');
    Route::get('bill/remove/{id?}', 'MyBillController@remove')->name('bill.remove');
    Route::get('bill/pdf/{id?}', 'MyBillController@pdf')->name('bill.pdf');
    Route::get('bill/detail/{id?}', 'MyBillController@detail')->name('bill.detail');

    Route::get('user/getCreate/{id?}', 'MyUserController@getCreate')->name('user.getCreate');
    Route::post('user/getCreate/{id?}', 'MyUserController@postCreate')->name('user.postCreate');
});






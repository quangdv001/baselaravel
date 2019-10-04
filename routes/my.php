<?php

Route::get('/', 'MyHomeController@index')->name('home.index');
Route::get('/me', 'MyHomeController@me')->name('home.me');

Route::get('motel/search', 'MyMotelController@index')->name('motel.index');
Route::get('motel/show/{id}', 'MyMotelController@show')->name('motel.show');
Route::post('motel/create', 'MyMotelController@create')->name('motel.create');
Route::post('motel/update/{id}', 'MyMotelController@update')->name('motel.update');
Route::post('motel/duplicate', 'MyMotelController@duplicate')->name('motel.duplicate');
Route::post('motel/remove', 'MyMotelController@remove')->name('motel.remove');

Route::get('rent/search', 'MyRentController@index')->name('rent.index');
Route::get('rent/show/{id}', 'MyRentController@show')->name('rent.show');
Route::post('rent/create', 'MyRentController@create')->name('rent.create');
Route::post('rent/update/{id}', 'MyRentController@update')->name('rent.update');
Route::post('rent/duplicate', 'MyRentController@duplicate')->name('rent.duplicate');
Route::post('rent/remove', 'MyRentController@remove')->name('rent.remove');

Route::get('renter/search', 'MyRenterController@index')->name('renter.index');
Route::get('renter/show/{id}', 'MyRenterController@show')->name('renter.show');
Route::post('renter/create', 'MyRenterController@create')->name('renter.create');
Route::post('renter/update/{id}', 'MyRenterController@update')->name('renter.update');
Route::post('renter/duplicate', 'MyRenterController@duplicate')->name('renter.duplicate');
Route::post('renter/remove', 'MyRenterController@remove')->name('renter.remove');

Route::get('contract/search', 'MyContractController@index')->name('contract.index');
Route::get('contract/show/{id}', 'MyContractController@show')->name('motel.show');
Route::post('contract/create', 'MyContractController@create')->name('contract.create');
Route::post('contract/update/{id}', 'MyContractController@update')->name('contract.update');
Route::post('contract/duplicate', 'MyContractController@duplicate')->name('contract.duplicate');
Route::post('contract/remove', 'MyContractController@remove')->name('contract.remove');

Route::get('contract/renter/search', 'MyContractController@index')->name('contract.renter.index');
Route::get('contract/renter/show/{id}', 'MyContractController@showRenter')->name('contract.renter.show');
Route::post('contract/renter/create', 'MyContractController@createContractRenter')->name('contract.renter.create');
Route::post('contract/renter/update/{id}', 'MyContractController@updateContractRenter')->name('contract.renter.update');
Route::post('contract/renter/duplicate', 'MyContractController@duplicate')->name('contract.renter.duplicate');
Route::post('contract/renter/remove', 'MyContractController@removeContractRenter')->name('contract.renter.remove');

Route::get('contract/service/search', 'MyContractController@index')->name('contract.service.index');
Route::get('contract/service/show/{id}', 'MyContractController@showService')->name('contract.service.show');
Route::post('contract/service/create', 'MyContractController@createContractService')->name('contract.service.create');
Route::post('contract/service/update/{id}', 'MyContractController@updateContractService')->name('contract.service.update');
Route::post('contract/service/duplicate', 'MyContractController@duplicate')->name('contract.service.duplicate');
Route::post('contract/service/remove', 'MyContractController@removeContractSerivce')->name('contract.service.remove');

Route::get('service/search', 'MyServiceController@index')->name('service.index');
Route::get('service/show/{id}', 'MyServiceController@show')->name('service.show');
Route::post('service/create', 'MyServiceController@create')->name('service.create');
Route::post('service/update/{id}', 'MyServiceController@update')->name('service.update');
Route::post('service/duplicate', 'MyServiceController@duplicate')->name('service.duplicate');
Route::post('service/remove', 'MyServiceController@remove')->name('service.remove');

Route::get('formula/search', 'MyFormulaController@index')->name('formula.index');
Route::get('formula/show/{id}', 'MyFormulaController@show')->name('formula.show');
Route::post('formula/create', 'MyFormulaController@create')->name('formula.create');
Route::post('formula/update/{id}', 'MyFormulaController@update')->name('formula.update');
Route::post('formula/duplicate', 'MyFormulaController@duplicate')->name('formula.duplicate');
Route::post('formula/remove', 'MyFormulaController@remove')->name('formula.remove');

Route::get('formula/detail/search', 'MyFormulaDetailController@index')->name('formula.detail.index');
Route::get('formula/detail/show/{id}', 'MyFormulaDetailController@show')->name('formula.detail.show');
Route::post('formula/detail/create', 'MyFormulaDetailController@create')->name('formula.detail.create');
Route::post('formula/detail/update/{id}', 'MyFormulaDetailController@update')->name('formula.detail.update');
Route::post('formula/detail/duplicate', 'MyFormulaDetailController@duplicate')->name('formula.detail.duplicate');
Route::post('formula/detail/remove', 'MyFormulaDetailController@remove')->name('formula.detail.remove');

Route::get('bill/search', 'MyBillController@index')->name('bill.index');
Route::get('bill/show/{id}', 'MyBillController@show')->name('bill.show');
Route::post('bill/create', 'MyBillController@create')->name('bill.create');
Route::post('bill/update/{id}', 'MyBillController@update')->name('bill.update');
Route::post('bill/duplicate', 'MyBillController@duplicate')->name('bill.duplicate');
Route::post('bill/remove', 'MyBillController@remove')->name('bill.remove');

Route::get('bill/service/search', 'MyBillController@listBillService')->name('bill.service.index');
Route::get('bill/service/show/{id}', 'MyBillController@showService')->name('bill.service.show');
Route::post('bill/service/create', 'MyBillController@createBillService')->name('bill.service.create');
Route::post('bill/service/update/{id}', 'MyBillController@updateBillService')->name('bill.service.update');
Route::post('bill/service/duplicate', 'MyBillController@duplicate')->name('bill.service.duplicate');
Route::post('bill/service/remove', 'MyBillController@removeBillService')->name('bill.service.remove');





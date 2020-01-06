<?php

Route::get('motel', 'MyMotelController@index')->name('motel.getList');
Route::get('motel/getCreate/{id?}', 'MyMotelController@getCreate')->name('motel.getCreate');
Route::post('motel/getCreate/{id?}', 'MyMotelController@postCreate')->name('motel.postCreate');
Route::get('motel/remove/{id?}', 'MyMotelController@remove')->name('motel.remove');






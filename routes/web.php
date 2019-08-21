<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::view('/manage/{any}', 'welcome')->where('any', '.*');

Route::namespace('Admin')->name('admin.')->group(function () {
    require_once('admin.php');
});

Route::namespace('Site')->name('site.')->group(function () {
    require_once('site.php');
});

Route::namespace('My')->name('my.')->prefix('my')->middleware(['auth.my'])->group(function () {
    require_once('my.php');
});


// Route::view('manage/{any}', function () {
//     return view('welcome');
// })->where('any', '.*');


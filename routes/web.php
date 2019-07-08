<?php
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderNew;
use Illuminate\Support\Facades\App;

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
Auth::routes();

// Route::get('/', function () {
//     return view('welcome');
// });

Route::namespace('Admin')->name('admin.')->group(function () {
    require_once('admin.php');
});

Route::namespace('Site')->name('site.')->group(function () {
    require_once('site.php');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/testMail', function(){
    $order = Order::find(1);
    $user = App\User::find(2);
    // return (new OrderNew($order))->render();
    // Mail::to('quangdv001@gmail.com')->send(new OrderNew($order));
    Mail::to($user)->send(new OrderNew($order));
});

Route::get('setLocale/{locale}', function($locale){
    App::setLocale($locale);
    $locale = App::getLocale();
    dd($locale);
});
Route::get('getLocale', function(){
    dd(session()->all());
    $locale = App::getLocale();
    dd($locale);
});
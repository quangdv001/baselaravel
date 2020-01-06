<?php
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderNew;

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

Route::namespace('My')->name('my.')->prefix('my')->group(function () {
    require_once('my.php');
});

Route::namespace('Site')->name('site.')->group(function () {
    require_once('site.php');
});


// Route::get('/testMail', function(){
//     $order = Order::find(1);
//     $user = App\User::find(2);
//     // return (new OrderNew($order))->render();
//     // Mail::to('quangdv001@gmail.com')->send(new OrderNew($order));
//     Mail::to($user)->send(new OrderNew($order));
// });
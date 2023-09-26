<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TopController;
use App\Http\Controllers\HistoryController;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResetPasswordController;

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


Route::resource('users', 'UserController');
Route::resource('carts', 'CartController');
Route::resource('products', 'ProductController');
Route::resource('orders', 'OrderController');
Route::resource('likes', 'LikeController');
Route::resource('reviews', 'ReviewController');
Route::resource('details', 'DetailController');
Route::resource('tops', 'TopController');
Route::resource('historys', 'HistoryController');



Route::post('/products/{id}/toggle-visibility', 'ProductController@toggleVisibility')->name('products.toggleVisibility');

Route::get('/', 'HomeController@index')->name('top');
Route::get('/item/detail/{item}', 'TopController@show')->name('details.detail');
Route::get('/carts/{item}', 'CartController@show')->name('carts.cart');
Route::get('/cart', 'CartController@index')->name('cart');
Route::get('/products', 'ProductController@index')->name('product');
//「ajaxlike.jsファイルのurl:'ルーティング'」に書くものと合わせる。
Route::post('ajaxlike', 'TopController@ajaxlike')->name('tops.ajaxlike');
Route::get('/like', 'LikeController@index')->name('like');
Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit');








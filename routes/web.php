<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::redirect('/', '/home');

Route::middleware('auth')
    ->group(function (){
        Route::resource('positions', 'PositionController');
        Route::resource('users', 'UserController');
        Route::resource('clients', 'ClientController');
        Route::resource('tables', 'TableController');
        Route::resource('ingredients', 'IngredientController');
        Route::resource('dishes', 'DishController');

        Route::resource('orders', 'OrderController');
        Route::get('/orders/{order}/toggle', 'OrderController@toggle')->name('orders.toggle');

        Route::resource('reservations', 'ReservationController');
    });


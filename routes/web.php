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
    return view('main');
})->name('home');

Route::resource('/workplace','WorkplaceController');

Route::post('equipment/detach','EquipmentController@detach')->name('equipment.detach');
Route::resource('/equipment','EquipmentController');



Auth::routes();

//Route::get('/', 'HomeController@index')->name('home');

Route::prefix('reservation')->name('reservation')->group(function (){
    Route::get('list', 'ReservationController@list')->name('.list');
    Route::get('{reservation}/show','ReservationController@show')->name('.show');
    Route::delete('{reservation}/destroy','ReservationController@destroy')->name('.destroy');
    Route::get('','ReservationController@choose_workplace');
    Route::get('reservation/{workplace}/details','ReservationController@reservation')->name('.details');
    Route::post('reservation/{workplace}/make','ReservationController@make')->name('.make');
    Route::post('reservation/{workplace}/fetch_reservation_of_day_url','ReservationController@fetch_reservation_of_day')->name('.fetch_reservation_of_day');
});

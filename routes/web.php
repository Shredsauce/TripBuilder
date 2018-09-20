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

Route::get('/', 'PageController@index');

// Route::get('flights/{departure_airport}/{arrival_airport}', 'PageController@flights');
Route::get('flights/{A?}/{B?}/{C?}/{D?}/{E?}/{F?}/{G?}/{H?}/{I?}/{J?}', 'PageController@flights');

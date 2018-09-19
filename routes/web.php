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

Route::get('flights/{departure_airport}/{arrival_airport}', 'PageController@flights');

// Route::get('/flights', 'PageController@flights');

// Route::get('flights/', [
//     'uses' => 'TripController@getFlights'
// ]);

// Route::get('airports/', [
//     'uses' => 'TripController@getAirports'
// ]);

// Route::get('airlines/', [
//     'uses' => 'TripController@getAirlines'
// ]);


// Route::get('flights/{id}', [
//     'uses' => 'TripController@getFlights'
// ]);

// Route::get('flights/{id}', function ($id) {
//     return 'FLIGHT '.$id;
// });


// Route::get('flights', 'PageController@flights2');

// Route::resource('flights', 'TripController');


// Route::get('/', function () {
//     return view('home');
// });

/*
Route::get('/home', function () {
   	return '<h1>Hello World</h1>';
});
*/
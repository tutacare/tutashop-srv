<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//route items with auth.jwt
Route::group(['middleware' => ['auth.jwt']], function () {
	Route::post('/item', 'ItemController@postItem');
	Route::get('/item/{id}', 'ItemController@showItem');
	Route::put('/item/{id}', 'ItemController@editItem');
	Route::delete('/item/{id}', 'ItemController@deleteItem');
});
Route::get('/item', 'ItemController@getItem');

//route signin
Route::post('user/signin', 'UserController@signin');


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

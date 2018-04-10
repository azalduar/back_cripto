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
Route::get('/friends/{user}', 'UserController@friendsById');


Route::resource('ratings', 'RatingController');
Route::resource('tags', 'TagController');
Route::resource('categories', 'CategoryController');
Route::resource('platforms', 'PlatformController');
Route::resource('games', 'GameController');
Route::resource('users', 'UserController');

Route::middleware('auth:api')->group(function(){
	Route::middleware('account-actived')->group(function(){

		Route::get('/me', function (Request $request) {
		    return response()->json([
		    	'data' => $request->user()
		    ]);
		});

		//Route::get('get-accept-friendships', 'UserController@getAcceptFriendships');
		Route::get('posibles-amigos', 'UserController@posiblesAmigos');
		Route::get('solicitudes', 'UserController@solicitudes');
		Route::get('friends', 'UserController@friends');//lista de amigos
		Route::get('friends/{user}/games', 'UserController@getFriend');//ver amigo con juegos
		Route::post('befriend/{user}', 'UserController@befriend');//enviar solicitud de amistad
		Route::post('accept-friend-request/{user}', 'UserController@acceptFriendRequest');//acerptar solicitud
		Route::post('deny-friend-request/{user}', 'UserController@denyFriendRequest');//rechazar solicitud
		Route::post('add-game/{game}', 'UserController@addGame');//adicionar juego
		Route::post('remove-game/{game}', 'UserController@removeGame');//remover juego
	});
});

//busquedas
Route::get('platforms/{platform}/games','PlatformController@games');
Route::get('tags/{tag}/games','TagController@games');
Route::get('categories/{category}/games','CategoryController@games');
Route::get('ratings/{rating}/games','RatingController@games');

Route::post('login-user', 'LoginController@login');

//Route::any('soap', 'SoapController@wsdl');
Route::any('soap', 'SoapController@soap');
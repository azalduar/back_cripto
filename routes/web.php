<?php
use Illuminate\Http\Request;
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

Route::get('phpinfo', function(){
	phpinfo();
});

Route::get('register', function(){
	return redirect('/login');
});
Route::post('register', function(){
	return redirect('/login');
});

Route::get('/', function(){
	return redirect('/login');
});

Route::get('files/{name}', 'WebController@files');
Route::get('local-img/{name}/{w?}/{h?}', 'WebController@images');

Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
	//        // Uses Auth Middleware
	//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
	Route::group(['middleware'=>'role:admin'], function(){		
		Route::resource('section', 'SectionController');
		Route::resource('categories', 'AdminCategoryController');
		Route::resource('ratings', 'AdminRatingController');
		Route::resource('tags', 'AdminTagController');
		Route::resource('platforms', 'AdminPlatformController');
		Route::resource('games', 'AdminGameController');
		Route::resource('admin_users', 'AdminUsersController');
	});

	Route::group(['middleware' => 'role:usuario'], function(){
		
	});
});

Route::get('activate-account/{user}/{code}', 'UserController@activateAccount');

Route::any('profiles/wsdl', 'SoapController@wsdl');
Route::any('profiles/action', 'SoapController@soap');
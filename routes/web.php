<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
/*
 * Auth related routing
 */
Auth::routes();
//Route::get('/home', 'HomeController@index');
Route::get('user/activation/{token}', 'Auth\AuthController@activateUser')->name('user.activate');
/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', [
    'as' => 'home',
    'uses' => 'PagesController@home'
]);
/*
 * Registration
 */
Route::get('register', [
    'as' => 'register_path',
    'uses' => 'RegistrationController@create'
]);
Route::post('register', [
    'as' => 'register_path',
    'uses' => 'RegistrationController@store'
]);
Route::get('register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'RegistrationController@confirm'
]);
/*
 * Sessions
 */
Route::get('login', [
    'as' => 'login_path',
    'uses' => 'SessionsController@create'
]);
Route::post('login', [
    'as' => 'login_path',
    'uses' => 'SessionsController@store'
]);
Route::get('logout', [
    'as' => 'logout_path',
    'uses' => 'SessionsController@destroy',
])->middleware('auth');
/*
 * News
 */
Route::get('news', [
    'as' => 'news_path',
    'uses' => 'NewsController@create'
])->middleware('auth');
Route::post('news', [
    'as' => 'news_path',
    'uses' => 'NewsController@store'
])->middleware('auth');
Route::delete('news/delete/{id}', [
    'uses' => 'NewsController@delete',
    'as' => 'news_delete'
])->middleware('auth');
/*
 * RSS
 */
Route::get('rss', [
    'as' => 'rss_path',
    'uses' => 'RssController@getFeed'
]);


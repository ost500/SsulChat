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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/chat', 'HomeController@chat');

Route::get('/log_in', function () {
    Auth::loginUsingId(1);
});

Route::get('test', function(){
    event(new App\Events\testEvent());
    event(new App\Events\ChatEvent('ab','abc'));
    event(new App\Events\newEvent());
    event(new App\Events\test2Event());
});

Route::post('task', function(Request $request){



    event(new App\Events\newEvent($request->message));
});
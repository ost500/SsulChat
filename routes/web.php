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

Route::get('/', ['as' => 'main', 'uses' => 'MainController@main']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/mypage', ['as' => 'mypage', 'uses' => 'HomeController@mypage']);
Route::post('/mypage', ['as' => 'mypage.post', 'uses' => 'HomeController@mypagePost']);
Route::post('/mypage_picture', ['as' => 'mypage_picture.post', 'uses' => 'HomeController@myPicturePost']);

//Route::get('/chat', 'HomeController@chat');

Route::get('/log_in', function () {
    Auth::loginUsingId(1);
});

//Route::get('test', function(){
//    event(new App\Events\testEvent());
//    event(new App\Events\ChatEvent('ab','abc'));
//    event(new App\Events\newEvent());
//    event(new App\Events\test2Event());
//});

Route::post('chat', function (Request $request) {
    event(new App\Events\newEvent($request));
});
Route::post('like', function (Request $request) {
    event(new App\Events\likeEvent($request));
});

Route::get('/pages/', ['as' => 'pageList', 'uses' => 'MainController@pageList']);

Route::get('/pages/{id}', ['as' => 'pages', 'uses' => 'MainController@page']);
Route::get('/pages/{id}/setting', ['as' => 'pages.setting', 'uses' => 'PageController@pageSetting']);
Route::post('/pages/{id}/setting/fb_crawl', ['as' => 'pages.setting.fb_crawl', 'uses' => 'PageController@fbCrawl']);
Route::get('/pages/{id}/setting/chatting_create', ['as' => 'pages.setting.chatting_create', 'uses' => 'PageController@chattingCreate']);
Route::post('/pages/{id}/setting/chatting_create', ['as' => 'pages.setting.chatting.create', 'uses' => 'PageController@chattingCreatePost']);
Route::delete('/pages/{id}/setting/chatting_create', ['as' => 'pages.setting.chatting.delete', 'uses' => 'PageController@chattingCreateDelete']);
Route::post('/pages/{id}/setting/main_picture', ['as' => 'pages.setting.main_picture', 'uses' => 'PageController@changePageMainImage']);
Route::post('/pages/{id}/setting/background_picture', ['as' => 'pages.setting.background_picture', 'uses' => 'PageController@changePageBackgroundImage']);

Route::get('page_posts/{id}', ['as' => 'pages.posts', 'uses' => 'PageController@pagePosts']);

Route::get('/ssul', ['as' => 'ssul', 'uses' => 'MainController@ssul']);
Route::get('/chattings', ['as' => 'chattingList', 'uses' => 'MainController@chattingList']);


Route::post('/ssul', ['as' => 'ssul.create', 'uses' => 'MainController@ssulCreate']);

Route::get('/search', ['as' => 'search', 'uses' => 'MainController@search']);

Route::get('/chattings/{name}', ['as' => 'chattings', 'uses' => 'ChattingController@chattings']);

Route::get('/chattings/{name}/chat_only', ['as' => 'chatting_only', 'uses' => 'ChattingController@chatting_only']);

Route::get('/chattings/{name}/statistics', ['as' => 'chatting_statistics', 'uses' => 'ChattingController@statistics']);

Route::post('/teamselect', ['as' => 'team_select', 'uses' => 'ChattingController@teamSelect']);

Route::get('/facebook/login/', ['as' => 'facebookLogin', 'uses' => 'MainController@facebookLogin']);

Route::get('/facebook/callback', ['as' => 'facebookLoginCallback', 'uses' => 'MainController@facebookCallback']);

Route::get('/search_json', ['as' => 'search_json', 'uses' => 'MainController@search_json']);

Route::get('/chat_content/{ssulId}/{id}', ['as' => 'chat_content', 'uses' => 'ChattingController@chatContent']);

Route::get('mysitemap', 'MainController@mysitemap');

Route::get('instagram_redirect', ['as' => 'insta_redirect', 'uses' => 'MainController@instaRedirect']);

Route::get('create_page', ['as' => 'create_page', 'uses' => 'PageController@create_page']);
Route::post('create_page', ['as' => 'create.page.post', 'uses' => 'PageController@createPagePost']);

Route::get('statistics', ['as' => 'statistics', 'uses' => 'StatisticsController@statistics']);

Route::get('morph_statistics', ['as' => 'morph_statistics', 'uses' => 'StatisticsController@morphStatistics']);

Route::get('pages/{id}/statistics', ['as' => 'pages.statistics', 'uses' => 'StatisticsController@pageStatistics']);

Route::get('pages/{id}/morph_statistics', ['as' => 'pages.morph_statistics', 'uses' => 'StatisticsController@pageMorphStatistics']);

Route::get('chattings/{id}/morph_statistics', ['as' => 'chattings.morph_statistics', 'uses' => 'StatisticsController@chattingsMorphStatistics']);
Route::get('chattings/{id}/week_morph_statistics', ['as' => 'chattings.week_morph_statistics', 'uses' => 'StatisticsController@chattingsWeekMorphStatistics']);


Route::get('facebooktest', 'HomeController@fbtest');
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

use Illuminate\Http\Request;
/**
 * 显示所有任务
 */
Route::get('/', function () {
    return view('welcome');
});
Route::get('/abc', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index');
Route::get('/duobao369', 'jsonController@duobao369');
Route::get('/api_1yyg', 'jsonController@api_1yyg');
Route::get('get_duobaogoods_row', 'jsonController@get_duobaogoods_row');

Route::get('/redirect', function () {
    $query = http_build_query([
        'client_id' => '8',
        'redirect_uri' => 'http://blog.app/callback',
        'response_type' => 'code',
        'scope' => '',
    ]);

    return redirect('http://blog.app/oauth/authorize?'.$query);
});
Route::get('/callback', function (Request $request) {
    //$http = new GuzzleHttp\Client;
    $data = array([
        'grant_type' => 'authorization_code',
        'client_id' => '8',
        'client_secret' => 'client-secret',
        'redirect_uri' => 'http://blog.app/callback',
        'code' => $request->code,
    ]);
    $data = $this->GoCurl('http://blog.app/oauth/token','POST',$data);
    return json_decode($data, true);
});

Auth::routes();



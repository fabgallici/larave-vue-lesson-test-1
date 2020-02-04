<?php

use Illuminate\Http\Request;

Route::post('/user/token', 'ExtraController@getToken');
Route::post('/post/all', 'ExtraController@getAllPost') -> middleware('auth:api');
Route::post('/post/user', 'ExtraController@getMyPost') -> middleware('auth:api');

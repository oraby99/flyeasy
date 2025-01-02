<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');
Route::get('/terms-conditions', 'HomeController@conditions');
Route::get('/policy', 'HomeController@policy');

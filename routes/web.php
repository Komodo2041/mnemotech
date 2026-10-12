<?php

use Illuminate\Support\Facades\Route;

Route::get('/', "App\Http\Controllers\MainController@start");

Route::match(["get", "post"], '/add', "App\Http\Controllers\MainController@add");

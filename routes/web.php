<?php

use Illuminate\Support\Facades\Route;

Route::get('/', "App\Http\Controllers\MainController@start");

Route::match(["get", "post"], '/sylabize/combine', "App\Http\Controllers\SylabeController@combineList");

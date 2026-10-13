<?php

use Illuminate\Support\Facades\Route;

Route::get('/', "App\Http\Controllers\MainController@start");

Route::match(["get", "post"], '/add', "App\Http\Controllers\MainController@add");
Route::match(["get", "post"], '/edit/{id}', "App\Http\Controllers\MainController@edit");

Route::match(["get", "post"], '/testA/{v}/{nr}', "App\Http\Controllers\MainController@test");
Route::match(["get", "post"], '/testB/{v}/{nr}', "App\Http\Controllers\MainController@test");

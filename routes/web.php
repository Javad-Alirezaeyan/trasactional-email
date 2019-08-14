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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get("/", 'EmailController@showall');
Route::get("/showall", 'EmailController@showall');
Route::get("/compose", 'EmailController@compose');
Route::get("/detail/{id}", 'EmailController@detail');
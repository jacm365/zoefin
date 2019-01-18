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

Route::get('/{url}', 'UserDetailsController@index')->where(['url' => 'userdetails|'])->name('userdetails');
Route::get('/agentcontacts', 'AgentContactsController@index');
Auth::routes();


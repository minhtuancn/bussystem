
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

Route::get('/', 'WelcomeController@index')->name('index');
Route::post('/rotas', 'WelcomeController@search')->name('welcome.search');
//----------------------PASSAGENS---------------------------------------//
Route::post('/passagem/', 'PassagemController@create')->name('passagem.create');
Route::post('/passagem/store', 'PassagemController@store')->name('passagem.store');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home/users/', 'UserController@index')->name('user.index');
Route::get('/home/register/','UserController@create')->name('user.create');
Route::post('/home/users/', 'UserController@store')->name('user.store');
Route::get('/home/users/{id}/edit', 'UserController@edit')->name('user.edit');
Route::post('/home/users/{id}/edit', 'UserController@update')->name('user.update');
Route::get('/home/users/{id}/', 'UserController@destroy')->name('user.destroy');



// ----------------------------------ONIBUS
Route::get('/home/onibus/', 'OnibusController@index')->name('onibus.index');
Route::get('/home/onibus/create','OnibusController@create')->name('onibus.create');
Route::post('/home/onibus/', 'OnibusController@store')->name('onibus.store');
Route::get('/home/onibus/{id}/edit', 'OnibusController@edit')->name('onibus.edit');
Route::post('/home/onibus/{id}/edit', 'OnibusController@update')->name('onibus.update');
Route::get('/home/onibus/{id}/', 'OnibusController@destroy')->name('onibus.destroy');

//-------------------------------ROTAS----------------------------------

Route::get('/home/rotas/', 'RotasController@index')->name('rota.index');
Route::get('/home/rotas/create','RotasController@create')->name('rota.create');
Route::get('/home/rotas/{id}/show','RotasController@show')->name('rota.show');
Route::post('/home/rotas/', 'RotasController@store')->name('rota.store');
Route::get('/home/rotas/{id}/edit', 'RotasController@edit')->name('rota.edit');
Route::post('/home/rotas/{id}/edit', 'RotasController@update')->name('rota.update');
Route::get('/home/rotas/{id}', 'RotasController@destroy')->name('rota.destroy');

//---------------------------SUB_ROTAS--------------------------------
Route::get('home/sub_rotas','SubRotaController@index')->name('sub_rota.index');
Route::get('home/sub_rotas/create/{id}','SubRotaController@create')->name('sub_rota.create');
Route::get('home/sub_rotas/store/{id}','SubRotaController@store')->name('sub_rota.store');
Route::get('home/sub_rotas/update/{id}','SubRotaController@update')->name('sub_rota.update');
Route::get('home/sub_rotas/{id}','SubRotaController@destroy')->name('sub_rota.destroy');

//----------------------------CIDADES---------------------------------

Route::get('home/paradas/create/{id}','CidadeController@create')->name('cidades.create');
Route::post('home/paradas/','CidadeController@store')->name('cidades.store');
Route::get('/home/paradas/{id}/edit', 'CidadeController@edit')->name('cidades.edit');
Route::post('/home/paradas/{id}/edit', 'CidadeController@update')->name('cidades.update');
Route::get('/home/paradas/{id}/', 'CidadeController@destroy')->name('cidades.destroy');



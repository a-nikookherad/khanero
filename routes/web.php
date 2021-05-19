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

/*
 * home page
 */
Route::get('/', 'AppController@HomePage')->name('HomePage');

/*
* search host
*/
Route::post('search/host', 'AppController@SearchHost')->name('SearchHost');
/*
* search host by code
*/
Route::post('search/host-code', 'AppController@SearchHostByCode')->name('SearchHostByCode');
/*
* search host by key word
*/
Route::post('search/key-word', 'AppController@SearchKeyWord')->name('SearchKeyWord');
/*
* detail host
*/
Route::get('detail/host/{keyWord}', 'AppController@DetailHost')->name('DetailHost');
/*
* detail host
*/
Route::get('cancel-rule', 'AppController@DetailCancelRule')->name('DetailCancelRule');
/*
* detail host
*/
Route::get('login-jangi/{mobile}', 'AppController@LoginJangi')->name('LoginJangi');



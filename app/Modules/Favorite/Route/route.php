<?php

Route::group(['middleware'=>['web'],'namespace'=>'App\Modules\Favorite\Controllers'],function(){

    /*
     * set favorite
     */
    Route::post('set/favorite', 'FavoriteController@SetFavorite')->name('SetFavorite');

});


Route::group(['middleware'=>['web','UserMiddleware'],'namespace'=>'App\Modules\Favorite\Controllers'],function(){


    /*
     * index Favorite
     */
    Route::get('index/favorite', 'FavoriteController@IndexFavorite')->name('IndexFavorite');
    /*
     * index favorite
     */
    Route::get('delete/favorite/{id}', 'FavoriteController@DeleteFavorite')->name('DeleteFavorite');
    /*
     * store favorite
     */
    Route::post('favorite/delete', 'FavoriteController@FavoriteDelete')->name('FavoriteDelete');
    /*
     * favorite days
     */
    Route::post('favorite-days', 'FavoriteController@FavoriteDays')->name('FavoriteDays');

});


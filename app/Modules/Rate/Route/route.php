<?php

Route::group(['middleware'=>['web', 'UserMiddleware'],'namespace'=>'App\Modules\Rate\Controllers'],function(){

    //index route
    Route::get('index/rate', 'RateController@IndexRate')->name('IndexRate');

    //set rate introduction
    Route::get('set/rate/introduction/{code}', 'RateController@SetRateIntroduction')->name('SetRateIntroduction');

    //get rate number
    Route::get('get/data/user/{id}', 'RateController@GetDataUser')->name('GetDataUser');

    //get rate number
    Route::get('rate/rate-reserve/{id}', 'RateController@AjaxSetRate')->name('AjaxSetRate');

    //store rate
    Route::post('store-rate', 'RateController@StoreRate')->name('StoreRate');


    //index rate and comment
    Route::get('index/rate-comment', 'RateController@IndexRateAndComment')->name('IndexRateAndComment');

    //active comment and rate
    Route::get('active/comment-rate/{id}', 'RateController@ActiveCommentAndRate')->name('ActiveCommentAndRate');

    //get detail host
    Route::get('get/detail-host/{id}', 'RateController@GetDetailHost')->name('GetDetailHost');

    //get detail guest
    Route::get('get/detail-guest/{id}', 'RateController@GetDetailGuest')->name('GetDetailGuest');

    //get rate and comment
    Route::get('get/comment-rate/{id}', 'RateController@GetCommentAndRate')->name('GetCommentAndRate');

});
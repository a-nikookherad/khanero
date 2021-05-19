<?php

Route::group(['middleware'=>['web','AdminMiddleware'],'namespace'=>'App\Modules\SlideShow\Controllers'],function(){


    /*
     * index slide show
     */
    Route::get('index/slide-show', 'SlideShowController@IndexSlideShow')->name('IndexSlideShow');
    /*
     * store slide show
     */
    Route::post('store/slide-show', 'SlideShowController@StoreSlideShow')->name('StoreSlideShow');
    /*
     * edit slide show
     */
    Route::get('edit/slide-show/{id}', 'SlideShowController@EditSlideShow')->name('EditSlideShow');
    /*
     * update slide show
     */
    Route::post('update/slide-show', 'SlideShowController@UpdateSlideShow')->name('UpdateSlideShow');


});


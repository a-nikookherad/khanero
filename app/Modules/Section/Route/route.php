<?php

Route::group(['middleware'=>['web','AdminMiddleware'],'namespace'=>'App\Modules\Section\Controllers'],function() {

    /*
     * index Section
     */
    Route::get('index/Section', 'SectionController@IndexSection')->name('IndexSection');
    /*
     * update Section
     */
    Route::post('index/Section', 'SectionController@UpdateSection')->name('UpdateSection');


});
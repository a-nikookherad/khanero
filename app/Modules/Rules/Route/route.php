<?php

Route::group(['middleware'=>['web','AdminMiddleware'],'namespace'=>'App\Modules\Rules\Controllers'],function(){



    /* ***********************************************************************************************
     * rule type *************************************************************************************
     * **********************************************************************************************/
    /*
     * index rule
     */
    Route::get('index/rule', 'RulesController@IndexRule')->name('IndexRule');
    /*
     * store rule
     * */
    Route::post('store/rule', 'RulesController@StoreRule')->name('StoreRule');
    /*
     * edit rule
     */
    Route::get('edit/rule/{id}', 'RulesController@EditRule')->name('EditRule');
    /*
     * update rule
     */
    Route::post('update/rule', 'RulesController@UpdateRule')->name('UpdateRule');
    /*
     * active rule
     */
    Route::get('active/rule/{id}', 'RulesController@ActiveRule')->name('ActiveRule');

});


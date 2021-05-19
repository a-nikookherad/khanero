<?php

Route::group(['middleware'=>['web','AdminMiddleware'],'namespace'=>'App\Modules\Possibilities\Controllers'],function(){

    /*
     * index possibilities
     */
    Route::get('index/possibilities', 'PossibilitiesController@IndexPossibilities')->name('IndexPossibilities');
    /*
     * store option
     * */
    Route::post('store/option', 'PossibilitiesController@StoreOption')->name('StoreOption');
    /*
     * edit menu
     */
    Route::get('edit/option/{id}', 'PossibilitiesController@EditOption')->name('EditOption');
    /*
     * update option
     */
    Route::post('update/option', 'PossibilitiesController@UpdateOption')->name('UpdateOption');
    /*
     * active option
     */
    Route::get('active/option/{id}', 'PossibilitiesController@ActiveOption')->name('ActiveOption');



    /* ***********************************************************************************************
     * home type *************************************************************************************
     * **********************************************************************************************/
    /*
     * index home type
     */
    Route::get('index/home-type', 'PossibilitiesController@IndexHomeType')->name('IndexHomeType');
    /*
     * store home type
     * */
    Route::post('store/home-type', 'PossibilitiesController@StoreHomeType')->name('StoreHomeType');
    /*
     * edit home type
     */
    Route::get('edit/home-type/{id}', 'PossibilitiesController@EditHomeType')->name('EditHomeType');
    /*
     * update home type
     */
    Route::post('update/home-type', 'PossibilitiesController@UpdateHomeType')->name('UpdateHomeType');
    /*
     * active home type
     */
    Route::get('active/home-type/{id}', 'PossibilitiesController@ActiveHomeType')->name('ActiveHomeType');

    /* ***********************************************************************************************
     * building type *************************************************************************************
     * **********************************************************************************************/
    /*
     * index building
     */
    Route::get('index/building-type', 'PossibilitiesController@IndexBuildingType')->name('IndexBuildingType');
    /*
     * store building
     * */
    Route::post('store/building-type', 'PossibilitiesController@StoreBuildingType')->name('StoreBuildingType');
    /*
     * edit building
     */
    Route::get('edit/building-type/{id}', 'PossibilitiesController@EditBuildingType')->name('EditBuildingType');
    /*
     * update building
     */
    Route::post('update/building-type', 'PossibilitiesController@UpdateBuildingType')->name('UpdateBuildingType');
    /*
     * active building
     */
    Route::get('active/building-type/{id}', 'PossibilitiesController@ActiveBuildingType')->name('ActiveBuildingType');

    /* ***********************************************************************************************
     * position type *************************************************************************************
     * **********************************************************************************************/
    /*
     * index position
     */
    Route::get('index/position-type', 'PossibilitiesController@IndexPositionType')->name('IndexPositionType');
    /*
     * store position
     * */
    Route::post('store/position-type', 'PossibilitiesController@StorePositionType')->name('StorePositionType');
    /*
     * edit position
     */
    Route::get('edit/position-type/{id}', 'PossibilitiesController@EditPositionType')->name('EditPositionType');
    /*
     * update position
     */
    Route::post('update/position-type', 'PossibilitiesController@UpdatePositionType')->name('UpdatePositionType');
    /*
     * active position
     */
    Route::get('active/position-type/{id}', 'PossibilitiesController@ActivePositionType')->name('ActivePositionType');
});


<?php


Route::group(['middleware'=>['web','AdminMiddleware'],'namespace'=>'App\Modules\InfoCity\Controllers'],function() {

    /*
     * index info city *****
     */
    Route::get('index/info/city', 'InfoCityController@IndexInfoCity')->name('IndexInfoCity');
    /*
     * store info province *****
     */
    Route::post('store/info/province', 'InfoCityController@StoreInfoProvince')->name('StoreInfoProvince');
    /*
     * edit info province *****
     */
    Route::get('edit/info/province/{id}', 'InfoCityController@EditInfoProvince')->name('EditInfoProvince');
    /*
     * update info province *****
     */
    Route::post('update/info/province', 'InfoCityController@UpdateInfoProvince')->name('UpdateInfoProvince');
    /*
     * store info township *****
     */
    Route::post('store/info/township', 'InfoCityController@StoreInfoTownship')->name('StoreInfoTownship');
    /*
     * edit info township *****
     */
    Route::get('edit/info/township/{id}', 'InfoCityController@EditInfoTownship')->name('EditInfoTownship');
    /*
     * update info township *****
     */
    Route::post('update/info/township', 'InfoCityController@UpdateInfoTownship')->name('UpdateInfoTownship');
    /*
     * active info province *****
     */
    Route::get('active/info-province/{id}', 'InfoCityController@ActiveInfoProvince')->name('ActiveInfoProvince');
    /*
     * active info township *****
     */
    Route::get('active/info-township/{id}', 'InfoCityController@ActiveInfoTownship')->name('ActiveInfoTownship');

});

Route::group(['middleware'=>['web'],'namespace'=>'App\Modules\InfoCity\Controllers'],function() {


    /*
     * detail province *****
     */
    Route::get('detail-province/{id}', 'InfoCityController@DetailProvince')->name('DetailProvince');
    /*
     * detail township *****
     */
    Route::get('detail-township/{id}', 'InfoCityController@DetailTownship')->name('DetailTownship');
});
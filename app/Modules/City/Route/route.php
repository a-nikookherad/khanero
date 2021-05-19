<?php


Route::group(['middleware'=>['web'],'namespace'=>'App\Modules\City\Controllers'],function(){

    /*
     *
     * country
     *
     * */
    //country list
    Route::get('country/list','CountryController@CountryList')->name('CountryList');

    //change status country
    Route::post('country/status/change','CountryController@ChangeStatus')->name('ChangeCountryStatus');

    //delete country
    Route::get('country/delete/{id}','CountryController@DeleteCountry')->name('DeleteCountry');

    //edit country
    Route::post('country/edit','CountryController@EditCountry')->name('EditCountry');

    //add country
    Route::post('country/add','CountryController@AddCountry')->name('AddCountry');



    /*
     *
     * Province
     *
     * */
    Route::get('province/{id}','ProvinceController@ProvinceList')->name('ProvinceList');

    //add province
    Route::post('province/add','ProvinceController@AddProvince')->name('AddProvince');

    //edit province
    Route::post('province/edit','ProvinceController@EditProvince')->name('EditProvince');

    //change status
    Route::post('province/status/change','ProvinceController@ChangeStatus')->name('ChangeProvinceStatus');

    //delete
    Route::get('province/delete/{id}','ProvinceController@DeleteProvince')->name('DeleteProvince');

    /*
     *
     * city
     *
     * */
    Route::get('city/{id}','CityController@CityList')->name('CityList');

    //change status
    Route::post('city/status/change','CityController@ChangeCityStatus')->name('ChangeCityStatus');

    //add city
    Route::get('addCity','CityController@AddCityForm')->name('AddCityForm');
    Route::post('city/add','CityController@AddCity')->name('AddCity');

    //edit city
    Route::get('city/edit/{id}','CityController@EditCityForm')->name('EditCityForm');
    Route::post('city/edit/{id}','CityController@EditCity')->name('EditCity');

    //delete city
    Route::get('city/delete/{id}','CityController@DeleteCity')->name('DeleteCity');

    /*
     *
     * area
     *
     * */
    Route::get('index/area','AreaController@IndexArea')->name('IndexArea');

    // create area
    Route::post('create/area','AreaController@StoreArea')->name('StoreArea');

    //edit area
    Route::get('edit/area/{id}', 'AreaController@EditArea')->name('EditArea');

    // active area
    Route::get('active/area/{id}','AreaController@ActiveArea')->name('ActiveArea');

    // update area
    Route::post('update/area','AreaController@UpdateArea')->name('UpdateArea');



});




Route::group(['middleware'=>['web'],'namespace'=>'App\Modules\City\Controllers'],function(){

    //get province list
    Route::post('province/getList','ProvinceController@GetProvinceList')->name('GetProvinceList');

    //get city list
    Route::post('city/getList','CityController@GetCityList')->name('GetCityList');


    //get province
    Route::post('province/list/get','ProvinceController@AjaxProvinceList')->name('GetAjaxProvince');


    //get city
    Route::post('city/list/get','CityController@AjaxCityList')->name('GetAjaxCity');


    //get district
    Route::post('district/list/get','DistrictController@AjaxDistrict')->name('GetAjaxDistrict');


    //get district
    Route::post('area/list/get','AreaController@AjaxArea')->name('GetAjaxArea');


    //get district
    Route::post('province/list/get','DistrictController@AjaxProvinceDistrict')->name('AjaxProvinceDistrict');



});







Route::group(['middleware'=>['web'],'namespace'=>'App\Modules\City\Controllers'],function(){

    //index district
    Route::get('index/district', 'DistrictController@IndexDistrict')->name('IndexDistrict');

    //new district
    Route::get('new/district', 'DistrictController@NewDistrict')->name('NewDistrict');

    //store district
    Route::post('store/district', 'DistrictController@StoreDistrict')->name('StoreDistrict');

    //edit district
    Route::get('edit/district/{id}', 'DistrictController@EditDistrict')->name('EditDistrict');

    // update district
    Route::post('update/district','DistrictController@UpdateDistrict')->name('UpdateDistrict');

    //active district
    Route::get('active/district/{id}', 'DistrictController@ActiveDistrict')->name('ActiveDistrict');

});





Route::group(['middleware'=>['web'],'namespace'=>'App\Modules\City\Controllers'],function(){

    // index township
    Route::get('index/township','TownshipController@IndexTownship')->name('IndexTownship');

    // create township
    Route::post('create/township','TownshipController@StoreTownship')->name('StoreTownship');

    //edit township
    Route::get('edit/township/{id}', 'TownshipController@EditTownship')->name('EditTownship');

    //get township
    Route::post('township/list/get','TownshipController@AjaxTownshipList')->name('GetAjaxTownship');

    // active township
    Route::get('active/township/{id}','TownshipController@ActiveTownship')->name('ActiveTownship');

    // update township
    Route::post('update/township','TownshipController@UpdateTownship')->name('UpdateTownship');

});





Route::group(['middleware'=>['web'],'namespace'=>'App\Modules\City\Controllers'],function(){

    // index city
    Route::get('index/city','CityController@IndexCity')->name('IndexCity');

    // create city
    Route::post('create/city','CityController@StoreCity')->name('StoreCity');

    //edit city
    Route::get('edit/city/{id}', 'CityController@EditCity')->name('EditCity');

    //get city
    Route::post('city/list/get','CityController@AjaxCityList')->name('GetAjaxCity');

    // active city
    Route::get('active/city/{id}','CityController@ActiveCity')->name('ActiveCity');

    // update city
    Route::post('update/city','CityController@UpdateCity')->name('UpdateCity');

});
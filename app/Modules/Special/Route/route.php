<?php

Route::group(['middleware'=>['web'],'namespace'=>'App\Modules\Special\Controllers'],function(){


    /*
     * index calendar
     */
    Route::post('calendar/change', 'SpecialController@CalendarChange')->name('CalendarChange');

});

Route::group(['middleware'=>['web', 'AdminMiddleware'],'namespace'=>'App\Modules\Special\Controllers'],function(){

    /*
     * delete date calendar
     */
    Route::get('delete/date/calendar/{id}', 'SpecialController@DeleteDateCalendar')->name('DeleteDateCalendar');

});


Route::group(['middleware'=>['web','UserMiddleware'],'namespace'=>'App\Modules\Special\Controllers'],function(){

    /*
     * index Special
     */
    Route::get('index/special', 'SpecialController@IndexSpecial')->name('IndexSpecial');
    /*
     * store special
     */
    Route::post('store/special', 'SpecialController@StoreSpecial')->name('StoreSpecial');
    /*
     * index Special
     */
    Route::get('edit/special/{id}', 'SpecialController@EditSpecial')->name('EditSpecial');
    /*
     * store special
     */
    Route::post('update/special', 'SpecialController@UpdateSpecial')->name('UpdateSpecial');
    /*
     * delete Special
     */
    Route::get('delete/special/{id}', 'SpecialController@DeleteSpecial')->name('DeleteSpecial');
    /*
     * delete special
     */
    Route::post('special/delete', 'SpecialController@SpecialDelete')->name('SpecialDelete');
    /*
     * special days
     */
    Route::post('special-days', 'SpecialController@SpecialDays')->name('SpecialDays');
    /*
     * set date calendar
     */
    Route::post('set/date-calendar', 'SpecialController@SetDateCalendar')->name('SetDateCalendar');
    /*
     * index calendar
     */
    Route::get('index/calendar', 'SpecialController@IndexCalendar')->name('IndexCalendar');

});


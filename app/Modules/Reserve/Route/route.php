<?php

Route::group(['middleware'=>['web','UserMiddleware'],'namespace'=>'App\Modules\Reserve\Controllers'],function(){

    /*
     * index reserve
     */
    Route::get('index/reserve', 'ReserveController@IndexReserve')->name('IndexReserve');
    /*
     * index reserve my host
     */
    Route::get('index/reserve-my-host', 'ReserveController@IndexReserveMyHost')->name('IndexReserveMyHost');
    /*
     * reserve cancel by client
     */
    Route::get('reserve/cancel-client/{id}', 'ReserveController@CancelReserveByClient')->name('CancelReserveByClient');
    /*
     * reserve cancel by client
     */
    Route::post('reserve/delete-client-host', 'ReserveController@DeleteReserveByClient')->name('DeleteReserveByClient');
    /*
     * reserve cancel by host user
     */
    Route::get('reserve/cancel-host/{id}', 'ReserveController@CancelReserveByHostUser')->name('CancelReserveByHostUser');
    /*
     * reserve cancel by host user
     */
    Route::post('reserve/delete-host', 'ReserveController@DeleteReserveByHostUser')->name('DeleteReserveByHostUser');
    /*
     * reserve confirm sms
     */
    Route::get('reserve/confirm-sms/{code}', 'ReserveController@ReserveBySMS')->name('ReserveBySMS');
    /*
     * detail price
     */
    Route::get('detail/price-reserve/{code}', 'ReserveController@DetailPriceReserve')->name('DetailPriceReserve');
    /*
     * description canceled
     */
    Route::post('description-canceled', 'ReserveController@DescriptionCancel')->name('DescriptionCancel');

});

Route::group(['middleware'=>['web'],'namespace'=>'App\Modules\Reserve\Controllers'],function(){
    /*
     * reserve by date
     */
    Route::post('reserve-by-date', 'ReserveController@ReserveHostByDate')->name('ReserveHostByDate');
    /*
     * calculate reserve by date
     */
    Route::post('calculate/reserve-by-date-ajax', 'ReserveController@CalculateReserveHostByDateAjax')->name('CalculateReserveHostByDateAjax');


    /** cron job for expire reserve time */
    Route::get('calculate-expire-time-reserve', 'ReserveController@CalculateExpireTimeReserve')
        ->name('CalculateExpireTimeReserve');

    /** cron job for expire reserve time before result host user */
    Route::get('calculate-expire-time-reserve-host', 'ReserveController@CalculateExpireTimeReserveBeforeResultHost')
        ->name('CalculateExpireTimeReserveBeforeResultHost');
});


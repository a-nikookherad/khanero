<?php

Route::group(['middleware'=>['web','AdminMiddleware'],'namespace'=>'App\Modules\Report\Controllers'],function(){

    /*
     * index report credit
     */
    Route::get('index/report/credit', 'ReportController@IndexReportCredit')->name('IndexReportCredit');
    /*
     * clear credit user
     */
    Route::get('clear/credit/user/{id}/{status}', 'ReportController@ClearingCreditUser')->name('ClearingCreditUser');
    /*
     * index report reserve
     */
    Route::get('index/report/reserve', 'ReportController@IndexReportReserve')->name('IndexReportReserve');
    /*
     * index report chart
     */
    Route::get('index/report/chart', 'ReportController@IndexReportChart')->name('IndexReportChart');
    /*
     * index all credit
     */
    Route::get('index/all/credit', 'ReportController@IndexAllCredit')->name('IndexAllCredit');

});


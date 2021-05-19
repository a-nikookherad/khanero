<?php

Route::group(['middleware'=>['web'],'namespace'=>'App\Modules\Sms\Controllers'],function(){


    /*
     * get sms
     */
//    Route::get('get-sms', 'SmsController@GetSms')->name('GetSms');


    Route::get('get-sms', array('as' => 'from/to/body', 'uses' => 'SmsController@GetSms'))->name('GetSms');


    Route::get('send/sms', 'SmsController@SendSms')->name('SendSms');

    Route::post('send/sms/user', 'SmsController@SendSmsUser')->name('SendSmsUser');

});


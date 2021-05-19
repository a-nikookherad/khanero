<?php

Route::group(['middleware'=>['web', 'AdminMiddleware'],'namespace'=>'App\Modules\Payment\Controllers'],function(){

    // description payment
    Route::post('store/description/payment', 'PaymentController@StoreDescriptionPayment')->name('StoreDescriptionPayment');

});


Route::group(['middleware'=>['web', 'UserMiddleware'],'namespace'=>'App\Modules\Payment\Controllers'],function(){

    // payment reserve
    Route::post('payment/reserve', 'PaymentController@PaymentReserve')->name('PaymentReserve');

    // payment reserve with wallet
    Route::post('payment/reserve/with/wallet', 'PaymentController@PaymentReserveWithWallet')->name('PaymentReserveWithWallet');

    // page payment reserve
    Route::get('detail/payment-reserve/{code}', 'PaymentController@DetailPaymentReserve')->name('DetailPaymentReserve');

    //index payment
    Route::get('index/payment', 'PaymentController@IndexPayment')->name('IndexPayment');

    //bank portal charge
    Route::post('reserve/bank/portal', 'PaymentController@BankPortal')->name('BankPortal');

    //callback bank portal
    Route::get('callback/bank/url/charge', 'PaymentController@CallbackURL')->name('CallbackURL');

    //store account
    Route::post('store/account', 'PaymentController@StoreAccount')->name('StoreAccount');

    //delete account
    Route::get('delete/account/{id}', 'PaymentController@DeleteAccount')->name('DeleteAccount');



    /** wallet **/

    Route::get('index/charge/wallet', 'PaymentController@IndexChargeWallet')->name('IndexChargeWallet');

    Route::post('charge/wallet', 'PaymentController@ChargeWallet')->name('ChargeWallet');

    Route::get('callback/bank/url/wallet', 'PaymentController@CallbackURLWallet')->name('CallbackURLWallet');




    /** Mellat Bank */


    //callback bank portal mellat
    Route::get('callback/bank/url/mellat', 'PaymentController@CallbackURLMellat')->name('CallbackURLMellat');

});
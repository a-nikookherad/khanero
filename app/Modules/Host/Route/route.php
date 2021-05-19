<?php


Route::group(['middleware'=>['web','AdminMiddleware'],'namespace'=>'App\Modules\Host\Controllers'],function() {

    /*
     * status host
     */
    Route::get('status/host/{id}/{status}', 'HostController@StatusHost')->name('StatusHost');
    /*
     * status host
     */
    Route::get('status/host/success-sms/{id}', 'HostController@StatusHostSendSms')->name('StatusHostSendSms');
    /*
     * store description host
     */
    Route::post('store/description/host', 'HostController@StoreDescriptionHost')->name('StoreDescriptionHost');
    /*
     * active integrated
     */
    Route::get('active/integrated/{id}', 'HostController@ActiveIntegrated')->name('ActiveIntegrated');

});


Route::group(['middleware'=>['web','UserMiddleware'],'namespace'=>'App\Modules\Host\Controllers'],function() {

    /*
     * index host
     */
    Route::get('index/host/{type}', 'HostController@IndexHost')->name('IndexHost');
    /*
     * create host
     */
    Route::get('create/host', 'HostController@CreateHost')->name('CreateHost');
    /*
     * create integrated
     */
    Route::get('create/integrated', 'HostController@CreateIntegrated')->name('CreateIntegrated');
    /*
     * store integrated
     */
    Route::post('store/integrated', 'HostController@StoreIntegrated')->name('StoreIntegrated');
    /*
     * edit integrated
     */
    Route::get('edit/integrated/{id}', 'HostController@EditIntegrated')->name('EditIntegrated');
    /*
     * update integrated
     */
    Route::post('update/integrated', 'HostController@UpdateIntegrated')->name('UpdateIntegrated');
    /*
     * add host integrated
     */
    Route::get('add/host-integrated/{id}', 'HostController@AddHostIntegrated')->name('AddHostIntegrated');
    /*
     * index host integrated
     */
    Route::get('index/host-integrated/{id}', 'HostController@IndexHostIntegrated')->name('IndexHostIntegrated');
    /*
     * active host
     */
    Route::get('active/host/{id}', 'HostController@ActiveHost')->name('ActiveHost');
    /*
     * confirm rules
     */
    Route::post('confirm/rules', 'HostController@ConfirmRules')->name('ConfirmRules');

    /**  ***************************************************************************************** */
    /*
     * store host
     */
    Route::post('store/host-step-1', 'HostController@StoreHostStep1')->name('StoreHostStep1');
    /*
     * store host 2
     */
    Route::post('store/host-step-2', 'HostController@StoreHostStep2')->name('StoreHostStep2');
    /*
     * store host3
     */
    Route::post('store/host-step-3', 'HostController@StoreHostStep3')->name('StoreHostStep3');
    /*
     * store host4
     */
    Route::post('store/host-step-4', 'HostController@StoreHostStep4')->name('StoreHostStep4');
    /*
     * store host5
     */
    Route::post('store/host-step-5', 'HostController@StoreHostStep5')->name('StoreHostStep5');
    /*
     * store host6
     */
    Route::post('store/host-step-6', 'HostController@StoreHostStep6')->name('StoreHostStep6');
    /*
     * store host7
     */
    Route::post('store/host-step-7', 'HostController@StoreHostStep7')->name('StoreHostStep7');
    /*
     * step host
     */
    Route::get('create-step/{id}/{step}', 'HostController@CreateHostStep')->name('CreateHostStep');
    /*
     * store closest time reserve
     */
    Route::post('store-closest-time-reserve', 'HostController@StoreClosestTimeReserve')->name('StoreClosestTimeReserve');
    /*
     * delete closest time reserve
     */
    Route::get('delete/closest/time/reserve/{id}', 'HostController@DeleteClosestTimeReserve')->name('DeleteClosestTimeReserve');
    /*
     * store-closest-time-reserve
     */
    Route::post('store-last-minute-reserve', 'HostController@StoreLastMinuteReserve')->name('StoreLastMinuteReserve');
    /*
     * delete last minute reserve
     */
    Route::get('delete/last/minute/reserve/{id}', 'HostController@DeleteLastMinuteReserve')->name('DeleteLastMinuteReserve');

    /**  ***************************************************************************************** */
    /*
     * store img host
     */
    Route::post('store/img-host', 'HostController@StoreImageHost')->name('StoreImageHost');
    /*
     * remove img host
     */
    Route::post('remove/img-host', 'HostController@RemoveImageHost')->name('RemoveImageHost');
    /*
     * ajax delete img
     */
    Route::post('delete/ajax-img', 'HostController@AjaxDeleteImg')->name('AjaxDeleteImg');
    /*
     * ajax delete img integrated
     */
    Route::post('delete/ajax-img/integrated', 'HostController@AjaxDeleteImgIntegrated')->name('AjaxDeleteImgIntegrated');

    /**  ***************************************************************************************** */
    /*
     * index blocked day
     */
    Route::get('index/blocked-days', 'HostController@IndexBlockedDays')->name('IndexBlockedDays');
    /*
     * store blocked day
     */
    Route::post('store/blocked-days', 'HostController@StoreBlockedDays')->name('StoreBlockedDays');
    /*
     * delete blocked day
     */
    Route::get('delete/blocked-days/{id}', 'HostController@DeleteBlockedDays')->name('DeleteBlockedDays');
    /*
     * delete blocked day
     */
    Route::post('blocked-days/delete', 'HostController@BlockedDaysDelete')->name('BlockedDaysDelete');
    /*
     * blocked days
     */
    Route::post('blocked-days', 'HostController@BlockedDays')->name('BlockedDays');
    /*
     * get blocked days
     */
    Route::post('get-blocked-days', 'HostController@GetBlockedDays')->name('GetBlockedDays');
    /*
     * get blocked days
     */
    Route::post('get-blocked-days-reserve-days', 'HostController@GetBlockedDaysAndReserveDays')->name('GetBlockedDaysAndReserveDays');
    /*
     * price set type
     */
    Route::post('price-set-type', 'HostController@PriceSetType')->name('PriceSetType');

    /**  ***************************************************************************************** */
    /*
     * edit host
     */
    Route::get('edit/host/{id}/{step}', 'HostController@EditHost')->name('EditHost');
    /*
     * edit host
     */
    Route::get('delete/host/{id}', 'HostController@DeleteHost')->name('DeleteHost');
    /*
     * update host
     */
    Route::post('update/host', 'HostController@UpdateHost')->name('UpdateHost');

    /**  ***************************************************************************************** */
    /*
     * edit step host
     */
    Route::post('edit/step-host', 'HostController@EditStep')->name('EditStep');
    /*
     * update step host
     */
    Route::post('update/step-host', 'HostController@UpdateHostStep')->name('UpdateHostStep');

    /*
     * index integrated
     */
    Route::get('index/integrated', 'HostController@IndexIntegrated')->name('IndexIntegrated');

    /*
     * get today price
     */
    Route::post('get-today-price', 'HostController@GetTodayPrice')->name('GetTodayPrice');



    /**  ***************************************************************************************** */
    /**
     *  PRICE DAY
     */
    Route::get('index/price-day', 'HostController@IndexPriceDay')->name('IndexPriceDay');
    /**
     *  Get PRICE DAY
     */
    Route::post('get/price-day', 'HostController@GetPriceDay')->name('GetPriceDay');
    /**
     * Update Price Host
     */
    Route::post('update/price-host', 'HostController@UpdatePriceHost')->name('UpdatePriceHost');





    /**  ***************************************************************************************** */
    /**
     *  Personalize The Days
     */
    Route::get('host/personalize/{id}', 'HostController@IndexPersonalize')->name('IndexPersonalize');
     /**
      *  Store Personalize Host
     */
    Route::post('store/personalize/host', 'HostController@StorePersonalizeHost')->name('StorePersonalizeHost');
    /*
     * factor
     */
    Route::get('host/factor', 'HostController@HostFactor')->name('HostFactor');
    /*
     * factor
     */
    Route::get('pishfactor/{type}', 'HostController@PishFactor')->name('PishFactor');

});


Route::group(['middleware'=>['web', 'CheckMiddleware'],'namespace'=>'App\Modules\Host\Controllers'],function() {

    /*
     * search index host
     */
    Route::post('search/index/host', 'HostController@SearchIndexHost')->name('SearchIndexHost');

});



Route::group(['middleware'=>['web'],'namespace'=>'App\Modules\Host\Controllers'],function() {

    /*
     * index calendar next
     */
    Route::post('calendar/change-user-next', 'HostController@CalendarChangeUserNext')->name('CalendarChangeUserNext');
    /*
     * index calendar prev
     */
    Route::post('calendar/change-user-prev', 'HostController@CalendarChangeUserPrev')->name('CalendarChangeUserPrev');
    /*
    * search host
    */
    Route::get('search', 'HostController@SearchHost')->name('SearchHost');
    /*
    * search host ajax
    */
    Route::post('search-ajax', 'HostController@SearchHostAjax')->name('SearchHostAjax');

});

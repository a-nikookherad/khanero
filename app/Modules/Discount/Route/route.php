<?php

Route::group(['middleware'=>['web','UserMiddleware'],'namespace'=>'App\Modules\Discount\Controllers'],function(){



    /* ***********************************************************************************************
     * Discount type *************************************************************************************
     * **********************************************************************************************/
    /*
     * index Discount
     */
    Route::get('index/discount', 'DiscountController@IndexDiscount')->name('IndexDiscount');
    /*
     * store Discount
     * */
    Route::post('store/discount', 'DiscountController@StoreDiscount')->name('StoreDiscount');
    /*
     * store Discount ajax
     * */
    Route::post('store/discount/ajax', 'DiscountController@StoreDiscountAjax')->name('StoreDiscountAjax');
    /*
     * delete Discount ajax
     * */
    Route::post('delete/discount/ajax', 'DiscountController@DeleteDiscountAjax')->name('DeleteDiscountAjax');
    /*
     * edit Discount
     */
    Route::get('edit/discount/{id}', 'DiscountController@EditDiscount')->name('EditDiscount');
    /*
     * update Discount
     */
    Route::post('update/discount', 'DiscountController@UpdateDiscount')->name('UpdateDiscount');
    /*
     * edit Discount
     */
    Route::get('delete/discount/{id}', 'DiscountController@DeleteDiscount')->name('DeleteDiscount');
    /*
     * update Discount
     */
    Route::post('discount/delete', 'DiscountController@DiscountDelete')->name('DiscountDelete');
    /*
     * active Discount
     */
    Route::get('active/discount/{id}', 'DiscountController@ActiveDiscount')->name('ActiveDiscount');

});


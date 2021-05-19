<?php

Route::group(['middleware'=>['web'],'namespace'=>'App\Modules\ContactUs\Controllers'],function() {

    /*
     * contact info
     */
    Route::get('contact/info', 'ContactUsController@ContactInfo')->name('ContactInfo');
    /*
     * contact info
     */
    Route::post('contact/store/user', 'ContactUsController@StoreContactUser')->name('StoreContactUser');

});

Route::group(['middleware'=>['web', 'AdminMiddleware'],'namespace'=>'App\Modules\ContactUs\Controllers'],function() {

    /*
     * view form contact-us
     */
    Route::get('contact-us/form/admin', 'ContactUsController@ContactUsFormAdmin')->name('ContactUsFormAdmin');
    /*
     * update form contact-us
     */
    Route::post('update/contact-us/form/admin', 'ContactUsController@UpdateFormContactUs')->name('UpdateFormContactUs');
    /*
     * index contact message
     */
    Route::get('index/contact/message', 'ContactUsController@IndexContactMessage')->name('IndexContactMessage');
    /*
     * read contact message
     */
    Route::get('read/contact/message/{id}', 'ContactUsController@ReadContactMessage')->name('ReadContactMessage');

});
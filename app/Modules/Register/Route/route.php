<?php


Route::group(['middleware'=>['web', 'CheckMiddleware'],'namespace'=>'App\Modules\Register\Controllers'],function() {

    //active account
    Route::post('update/account-bank', 'RegisterController@UpdateAccountBank')->name('UpdateAccountBank');


    //update confirm user
    Route::post('update/confirm-user', 'RegisterController@UpdateConfirmUser')->name('UpdateConfirmUser');




});


    Route::group(['middleware'=>['web'],'namespace'=>'App\Modules\Register\Controllers'],function(){

    //send sms
    Route::post('send-sms-code','RegisterController@SendCodeSms')->name('SendCodeSms');

    //register form
    Route::get('register','RegisterController@RegisterForm')->name('Register');

    //register user
    Route::post('store/new/user','RegisterController@StoreNewUser')->name('StoreNewUser');

    //register user with ajax
    Route::post('store/new/user/ajax','RegisterController@StoreNewUserAjax')->name('StoreNewUserAjax');

    //reagent code
    Route::post('reagent-code','RegisterController@ReagentCode')->name('ReagentCode');

    //reagent code
    Route::post('register-reagent-code','RegisterController@RegisterReagentCode')->name('RegisterReagentCode');

    //create image profile
    Route::get('create-image-profile','RegisterController@CreateBoxUploadImageProfile')->name('CreateBoxUploadImageProfile');

    //update image profile
    Route::post('update-image-profile','RegisterController@UpdateImageProfile')->name('UpdateImageProfile');


    //validate username
//    Route::post('register/validate/username','RegisterController@ValidateUserName')->name('ValidateUserName');


    /*
     *
     * Edit User
     *
     ***/
    //edit user
    Route::get('edit/user','RegisterController@EditUser')->name('EditUser');


    //Update user
    Route::post('update/user','RegisterController@UpdateUser')->name('UpdateUser');
    
    //profile info
    Route::post('register/profile','RegisterController@RegisterProfileInfo')->name('RegisterProfileInfo');


    //active user
//    Route::post('register/active','RegisterController@ActiveUser')->name('ActiveUser');

    //active account
    Route::get('account/active/{token}','RegisterController@ActiveAccount')->name('ActiveAccount');


    Route::get('Captcha','RegisterController@Captcha')->name('Captcha');
});


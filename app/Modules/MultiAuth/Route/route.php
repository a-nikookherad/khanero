<?php


/*reset password*/
Route::group(['middleware'=>['web'],'namespace'=>'App\Modules\MultiAuth\Controllers'],function(){

    Route::get('/logout','AuthController@LogOut')->name('Logout');

    Route::post('password/info/reset','AuthController@ResetPassword')->name('ResetPassword');

    Route::post('register/activity-user','AuthController@ActivityUser')->name('ActivityUser');



    /*admin login page*/

    Route::get('login','AuthController@LoginPage')->name('LoginPage');

    Route::post('login','AuthController@Login')->name('Login');


    /*user login page*/

    Route::post('check-user-ajax','AuthController@CheckUserAjax')->name('CheckUserAjax');

    Route::post('login-ajax','AuthController@LoginAjax')->name('LoginAjax');

    Route::post('default-login-ajax','AuthController@DefaultLoginAjax')->name('DefaultLoginAjax');

    Route::post('check-code-login','AuthController@CheckCodeLogin')->name('CheckCodeLogin');

    Route::post('register-ajax-user','AuthController@RegisterAjaxUser')->name('RegisterAjaxUser');

    Route::post('request-auth-sms/{types}','AuthController@AuthWithSms')->name('RequestSms');

    Route::post('login-auth-sms', 'AuthController@loginWithSmsCode')->name('LoginWithSmsCode');

    Route::post('change-user-password', 'AuthController@newPassword')->name('ChangePassword');

    /*
     * user Login page
     * */


    Route::get('recovery/password','AuthController@RecoveryPassword')->name('RecoveryPassword');

    Route::post('password/recovery','AuthController@PasswordRecovery')->name('PasswordRecovery');

});



/*register*/
Route::group(['middleware'=>['web' ],'namespace'=>'App\Modules\MultiAuth\Controllers'],function(){

    
    //active account
    Route::get('account/active/{token}','RegisterController@ActiveAccount')->name('ActiveAccount');


    /*ajax register*/
    Route::post('register/ajax','RegisterController@AjaxRegisterUser')->name('AjaxRegister');


});


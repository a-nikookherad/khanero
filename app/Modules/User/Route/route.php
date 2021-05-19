<?php

Route::group(['middleware'=>['web', 'AdminMiddleware'],'namespace'=>'App\Modules\User\Controllers'],function(){

    /*
     * index user
     */
    Route::get('index/user', 'UserController@IndexUser')->name('IndexUser');
    /*
     * login user
     */
    Route::get('login/user/{id}', 'UserController@LoginUser')->name('LoginUser');
    /*
     * index user confirm
     */
    Route::get('index/user/confirm', 'UserController@IndexUserConfirm')->name('IndexUserConfirm');
    /*
     * index user confirm
     */
    Route::get('detail/user/confirm/{id}', 'UserController@DetailConfirmUser')->name('DetailConfirmUser');
    /*
     * conform special user
     */
    Route::get('conform/special/user/{id}/{type}', 'UserController@ConfirmUserToSpecial')->name('ConfirmUserToSpecial');
    /*
     * active/deActive user
     */
    Route::get('active/user/{id}/active', 'UserController@StatusUser')->name('StatusUser');
    /*
     * detail user stylist
     */
    Route::get('detail/user/{id}', 'UserController@DetailUser')->name('DetailUser');
    /*
     * search user
     */
    Route::post('index/user', 'UserController@SearchUser')->name('SearchUser');

});

Route::group(['middleware'=>['web', 'UserMiddleware'],'namespace'=>'App\Modules\User\Controllers'],function() {

    /*
     * ajax detail user
     */
    Route::get('get/user-detail/{id}', 'UserController@AjaxDetailUser')->name('AjaxDetailUser');
    /*
     * index user reagent
     */
    Route::get('index/reagent-user', 'UserController@IndexReagentUser')->name('IndexReagentUser');
    /*
     * invite user
     */
    Route::get('invite/user', 'UserController@InviteUser')->name('InviteUser');

});

Route::group(['middleware'=>['web'],'namespace'=>'App\Modules\User\Controllers'],function() {

    /*
     * detail user
     */
    Route::get('user/{id}', 'UserController@DetailUserProfile')->name('DetailUserProfile');
    /*
     * invite link
     */
    Route::get('invite-friend/{id}', 'UserController@InviteFriend')->name('InviteFriend');

});
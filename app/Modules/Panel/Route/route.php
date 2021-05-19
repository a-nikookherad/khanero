<?php

/*Admin Dashboard*/
Route::group(['middleware'=>['web', 'AdminMiddleware'],'namespace'=>'App\Modules\Panel\Controllers'],function(){

    Route::get('admin/dashboard','PanelController@AdminDashboard')->name('AdminDashboard');

});


/*User Dashboard*/
Route::group(['middleware'=>['web', 'UserMiddleware'],'namespace'=>'App\Modules\Panel\Controllers'],function(){

    Route::get('user/dashboard','PanelController@UserDashboard')->name('UserDashboard');

});


/*Investor Dashboard*/
Route::group(['middleware'=>['web', 'InvestorMiddleware'],'namespace'=>'App\Modules\Panel\Controllers'],function(){

    Route::get('investor/dashboard','PanelController@InvestorDashboard')->name('InvestorDashboard');

});


/*Investor Dashboard*/
Route::group(['middleware'=>['web', 'ExpertMiddleware'],'namespace'=>'App\Modules\Panel\Controllers'],function(){

    Route::get('expert/dashboard','PanelController@ExpertDashboard')->name('ExpertDashboard');

});
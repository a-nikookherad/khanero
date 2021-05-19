<?php

Route::group(['middleware'=>['web', 'AdminMiddleware'],'namespace'=>'App\Modules\Content\Controllers'],function(){

    /*
     * index content
     */
    Route::get('index/content', 'ContentController@IndexContent')->name('IndexContent');
    /*
     * create content
     */
    Route::get('create/contents', 'ContentController@CreateContent')->name('CreateContent');
    /*
     * store content
     */
    Route::post('store/content', 'ContentController@StoreContent')->name('StoreContent');
    /*
     * edit content
     */
    Route::get('edit/content/{id}', 'ContentController@EditContent')->name('EditContent');
    /*
     * update content
     */
    Route::post('update/content', 'ContentController@UpdateContent')->name('UpdateContent');
    /*
     * active/deActive content
     */
    Route::get('active/content/{id}/active', 'ContentController@ActiveContent')->name('ActiveContent');

});


Route::group(['middleware'=>['web'],'namespace'=>'App\Modules\Content\Controllers'],function() {

    /*
     * load content
     */
    Route::get('content/{alias}', 'ContentController@PageContent')->name('PageContent');

});
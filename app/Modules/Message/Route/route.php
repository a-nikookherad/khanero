<?php



Route::group(['middleware'=>['web','CheckMiddleware'],'namespace'=>'App\Modules\Message\Controllers'],function() {

    /*
     * index message
     */
    Route::get('index/message', 'MessageController@IndexMessage')->name('IndexMessage');
    /*
     * index send message
     */
    Route::get('index/send-message', 'MessageController@IndexSendMessage')->name('IndexSendMessage');
    /*
     * read message
     */
    Route::get('read/message/{id}', 'MessageController@ReadMessage')->name('ReadMessage');
    /*
     * store reply message
     */
    Route::post('store/reply/message', 'MessageController@StoreReplyMessage')->name('StoreReplyMessage');
    /*
     * get number message
     */
    Route::get('message/get/number/{id}', 'MessageController@MessageGetNumber')->name('MessageGetNumber');
    /*
     * store message
     */
    Route::post('store/message', 'MessageController@StoreMessage')->name('StoreMessage');
    /*
     * store message for host user
     */
    Route::post('store/message/host-user', 'MessageController@StoreMessageForHostUser')->name('StoreMessageForHostUser');

});
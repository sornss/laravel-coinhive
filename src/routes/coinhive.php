<?php

Route::group(['prefix' => 'coinhive', 'middleware' => ['api']], function  () {
    
    Route::get('meta', 'Springbuck\LaravelCoinhive\Ctrls\CoinhiveCtrl@getMeta');

    Route::group(['prefix' => 'token'], function  () {
        Route::post(
            'verify', 
            'Springbuck\LaravelCoinhive\Ctrls\CoinhiveCtrl@postTokenVerify'
        )->name('coinhive.token.verify');
    });
    
    Route::group(['prefix' => 'links'], function  () {
        Route::post(
            'create', 
            'Springbuck\LaravelCoinhive\Ctrls\CoinhiveCtrl@postusersCreate'
        )->name('coinhive.users.create');
    });

    Route::group(['prefix' => 'user'], function  () {
        Route::get(
            'balance', 
            'Springbuck\LaravelCoinhive\Ctrls\CoinhiveCtrl@getUserBalance'
        )->name('coinhive.user.balance');

        Route::post(
            'withdraw', 
            'Springbuck\LaravelCoinhive\Ctrls\CoinhiveCtrl@postUserWithdraw'
        )->name('coinhive.user.withdraw');

        Route::get(
            'top', 
            'Springbuck\LaravelCoinhive\Ctrls\CoinhiveCtrl@getUserTop'
        )->name('coinhive.user.top');

        Route::get(
            'list', 
            'Springbuck\LaravelCoinhive\Ctrls\CoinhiveCtrl@getUserList'
        )->name('coinhive.user.list');

        Route::post(
            'reset', 
            'Springbuck\LaravelCoinhive\Ctrls\CoinhiveCtrl@postUserReset'
        )->name('coinhive.user.reset');

        Route::post(
            'reset-all', 
            'Springbuck\LaravelCoinhive\Ctrls\CoinhiveCtrl@postUserResetAll'
        )->name('coinhive.user.reset-all');
    });

    Route::group(['prefix' => 'stats'], function  () {
        Route::get(
            'payout', 
            'Springbuck\LaravelCoinhive\Ctrls\CoinhiveCtrl@getStatsPayout'
        )->name('coinhive.stats.payout');
        
        Route::get(
            'site', 
            'Springbuck\LaravelCoinhive\Ctrls\CoinhiveCtrl@getStatsSite'
        )->name('coinhive.stats.site');

        Route::get(
            'history', 
            'Springbuck\LaravelCoinhive\Ctrls\CoinhiveCtrl@getStatsHistory'
        )->name('coinhive.stats.history');
    });

    Route::get('version', 'Springbuck\LaravelCoinhive\Ctrls\CoinhiveCtrl@getMeta');
});
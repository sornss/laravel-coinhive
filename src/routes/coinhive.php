<?php

Route::group(['middleware' => ['api']], function () {

    Route::prefix('coinhive')->group(function () {

        Route::prefix('token')->group(function () {
            Route::post('verify', 'Springbuck\LaravelCoinhive\Ctrls\Coinhive@postTokenVerify')->name('coinhive.token.verify');
        });
        
        Route::prefix('links')->group(function () {
            Route::post('create', 'Springbuck\LaravelCoinhive\Ctrls\Coinhive@postusersCreate')->name('coinhive.users.create');
        });

        Route::prefix('user')->group(function () {
            Route::get('balance', 'Springbuck\LaravelCoinhive\Ctrls\Coinhive@getUserBalance')->name('coinhive.user.balance');
            Route::post('withdraw', 'Springbuck\LaravelCoinhive\Ctrls\Coinhive@postUserWithdraw')->name('coinhive.user.withdraw');
            Route::get('top', 'Springbuck\LaravelCoinhive\Ctrls\Coinhive@getUserTop')->name('coinhive.user.top');
            Route::get('list', 'Springbuck\LaravelCoinhive\Ctrls\Coinhive@getUserList')->name('coinhive.user.list');
            Route::post('reset', 'Springbuck\LaravelCoinhive\Ctrls\Coinhive@postUserReset')->name('coinhive.user.reset');
            Route::post('reset-all', 'Springbuck\LaravelCoinhive\Ctrls\Coinhive@postUserResetAll')->name('coinhive.user.reset-all');
        });

        Route::prefix('stats')->group(function () {
            Route::get('payout', 'Springbuck\LaravelCoinhive\Ctrls\Coinhive@getStatsPayout')->name('coinhive.stats.payout');
            Route::get('site', 'Springbuck\LaravelCoinhive\Ctrls\Coinhive@getStatsSite')->name('coinhive.stats.site');
            Route::get('history', 'Springbuck\LaravelCoinhive\Ctrls\Coinhive@getStatsHistory')->name('coinhive.stats.history');
        });

    });

});
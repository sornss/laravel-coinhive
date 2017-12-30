<?php

/*
 * API routes using Dingo\Api Package
 */

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function($api){
    $api->group(['prefix' => 'coinhive', 'middleware' => ['api.throttle']], function ($api) {
        
        $api->get('meta', 'Springbuck\LaravelCoinhive\Ctrls\CoinhiveCtrl@getMeta');

        $api->group(['prefix' => 'token'], function () {
            $api->post('verify', 'Springbuck\LaravelCoinhive\Ctrls\CoinhiveCtrl@postTokenVerify')->name('coinhive.token.verify');
        });
        
        $api->group(['prefix' => 'links'], function () {
            $api->post('create', 'Springbuck\LaravelCoinhive\Ctrls\CoinhiveCtrl@postusersCreate')->name('coinhive.users.create');
        });

        $api->group(['prefix' => 'user'], function () {
            $api->get('balance', 'Springbuck\LaravelCoinhive\Ctrls\CoinhiveCtrl@getUserBalance')->name('coinhive.user.balance');
            $api->post('withdraw', 'Springbuck\LaravelCoinhive\Ctrls\CoinhiveCtrl@postUserWithdraw')->name('coinhive.user.withdraw');
            $api->get('top', 'Springbuck\LaravelCoinhive\Ctrls\CoinhiveCtrl@getUserTop')->name('coinhive.user.top');
            $api->get('list', 'Springbuck\LaravelCoinhive\Ctrls\CoinhiveCtrl@getUserList')->name('coinhive.user.list');
            $api->post('reset', 'Springbuck\LaravelCoinhive\Ctrls\CoinhiveCtrl@postUserReset')->name('coinhive.user.reset');
            $api->post('reset-all', 'Springbuck\LaravelCoinhive\Ctrls\CoinhiveCtrl@postUserResetAll')->name('coinhive.user.reset-all');
        });

        $api->group(['prefix' => 'stats'], function () {
            $api->get('payout', 'Springbuck\LaravelCoinhive\Ctrls\CoinhiveCtrl@getStatsPayout')->name('coinhive.stats.payout');
            $api->get('site', 'Springbuck\LaravelCoinhive\Ctrls\CoinhiveCtrl@getStatsSite')->name('coinhive.stats.site');
            $api->get('history', 'Springbuck\LaravelCoinhive\Ctrls\CoinhiveCtrl@getStatsHistory')->name('coinhive.stats.history');
        });

        $api->get('version', 'Springbuck\LaravelAnalytics\Ctrls\AnalyticsCtrl@getMeta');
    });
});
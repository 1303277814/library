<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['middleware' =>'api.throttle','limit' =>60,'expires'=>1],function ($api) {
        //路由组
    $api->group(['prefix' =>'auth'],function ($api){
        //注册
        $api ->post('register',[\App\Http\Controllers\auth\RegisterController::class,'store']);
        //登录
        $api ->post('login',[\App\Http\Controllers\auth\LoginController::class,'login']);
        //选座位
        $api ->post('seat',[\App\Http\Controllers\auth\SeatController::class,'store']);


        //需要登录的路由
        $api->group(['middleware' =>'api.auth'],function ($api){
                $api->post('logout',[\App\Http\Controllers\Auth\LoginController::class,'logout']);
                //刷新token
                $api->post('refresh',[\App\Http\Controllers\Auth\LoginController::class,'refresh']);

                $api->post('pawd/update',[\App\Http\Controllers\Auth\LoginController::class,'update']);

        });
    });

});

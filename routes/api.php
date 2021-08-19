<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['middleware' =>'api.throttle','limit' =>60,'expires'=>1],function ($api) {
    $api->get('test', [\App\Http\Controllers\TestController::class,'index']);

    //命名路由
    $api->get('name', ['as' => 'test.name', 'uses' => '\App\Http\Controllers\TestController@name']);

    //执行登录
    $api->post('login', [\App\Http\Controllers\TestController::class,'login']);
//
//
//    $api->group(['middleware' =>'api.auth'],function ($api){
//        $api->get('users', [\App\Http\Controllers\TestController::class,'users']);
//    });
});

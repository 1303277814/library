<?php
//serializer:array //减少transform的层数

$api = app('Dingo\Api\Routing\Router');
$params =  [
    'middleware' =>
        ['api.throttle','dontknow','serializer:array'],
    'limit' =>60,
    'expires'=>1];

$api->version('v1',$params,function ($api) {

        //需要登录的路由
    $api->group(['middleware' =>'api.auth'],function ($api){
        $api->group(['prefix' => 'admin'],function ($api){
            /**
             * 用户管理
             */
            //禁用用户
            $api->patch('users/{user}/lock',[\App\Http\Controllers\Admin\UserController::class,'lock']);

            //用户管理资源路由
            $api->resource('users',\App\Http\Controllers\Admin\UserController::class,[
                'only' =>['index','show']
            ]);
            /**
             * 座位管理
             */
            //资源路由
            $api->resource('seats',\App\Http\Controllers\Web\SeatController::class,[
                'only' =>['index','show','update'.'destroy']
            ]);
            $api->get('find/{seat}',[\App\Http\Controllers\Web\SeatController::class,'find']);


        });
    });
});

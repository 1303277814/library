<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends BaseController
{
    public function index(){
        //使用响应生成器响应一个数组
        return $this->response->array(['name' => 'xiaoyu', 'age' => 12]);
    }

    public function name(){
       $url =  app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route('test.name');
       dd($url);
    }

    public function login(Request $request){
//        $email = $request ->input('email');
//        $password =$request ->input('password');
            //文档里的登录demo
        $credentials = request(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);

    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}

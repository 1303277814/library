<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends BaseController
{
    //
    /**
     * 登录.

     */
    public function login(LoginRequest $request)
    {

        $credentials = request(['name', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return $this->response->errorUnauthorized()->errorForbidden('密码或者用户名错误');
        }
        //检查用户信息
        $user = auth('api')->user();
        if ($user->is_lock == 1){
            return $this->response->errorForbidden('用户被加入黑名单');
        }
        return $this->respondWithToken($token);
    }

    /**
     *调用auth的辅助函数 传api，执行logout
     * 将token加入黑名单
     */
    public function logout()
    {
        auth('api')->logout();

        return $this->response->noContent();
    }

    /**
     * 刷新token，在失效后重新刷新
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
        格式化返回
     */
    protected function respondWithToken($token)
    {
        return $this->response->array([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
    public function update(Request $request){
            $request->validate([
                'old_password' =>'required',
                'password' => 'required|confirmed',
            ],[
                'old_password.required' =>'旧密码不能为空',
            ]);

            $user =auth('api')->user();
            if(!password_verify($request->input('old_password'),auth('api')->user()->password)){
                return $this->response->errorBadRequest('旧密码不正确');
            }
            $user->password = bcrypt($request->input('password'));
            $user->save();
            return $this->response->noContent();
    }
}

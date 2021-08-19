<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\BaseRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends BaseController
{
    //
    /**
     * 用户注册
     */

        public function store(RegisterRequest $request){
            $user = new User();
            $user->name = $request->input('name');
            $user->password = bcrypt($request->input('password'));
            $user->email = $request->input('email');
            $user->save();

            return $this->response->created();
//            return User::all();

        }
}

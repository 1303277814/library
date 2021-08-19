<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserTransformer;
use App\Models\Seat;
use App\Models\User;
use App\Transformers\UserTransformers;
use Illuminate\Http\Request;

class UserController extends BaseController
{

    //用户锁定和启动
    public function lock(Seat $user){
        $user->appointment = $user->appointment == 0?1:0;
        $user->save();
        return $this->response->noContent();
    }
    /**
     * 用户列表
     */
    public function index(Request $request)
    {
        //搜索
        $name = $request->input('name');
        $email = $request->input('email');


        //分页，使用when判断当搜索条件存在的时候进行模糊(like参数)搜索
        $users = User::when($name,function ($query) use ($name){
            $query->where('name','like',"%$name%");
        })
            ->when($email,function ($query) use ($email){
                $query->where('name',"%$email%");

            })
        ->paginate(2);
        //使用diogo api的响应方式
        return $this->response->paginator($users,new UserTransformers());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * 用户详情
     */
    public function show(User $user)
    {
        //
        return $this->response->item($user, new UserTransformers());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

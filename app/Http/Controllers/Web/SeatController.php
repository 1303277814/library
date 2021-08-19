<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SeatRequst;
use App\Models\Seat;
use App\Transformers\SeatTransformers;
use Illuminate\Http\Request;

class SeatController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //搜索
        $name = $request->input('name');
        $email = $request->input('email');
        $seat = $request->input('seat');



        //分页，使用when判断当搜索条件存在的时候进行模糊(like参数)搜索
        $users = Seat::when($name,function ($query) use ($name){
            $query->where('name','like',"%$name%");
        })
            ->when($email,function ($query) use ($email){
                $query->where('name',"%$email%");

            })
            ->when($seat,function ($query) use ($seat){
                $query->where('name',"%$seat%");
            })

            ->paginate(2);
        //使用diogo api的响应方式
        return $this->response->paginator($users,new SeatTransformers());
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Seat $seat)
    {
        //
        return $this->response->item($seat, new SeatTransformers());

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
        $seat = Seat::find($id);
        $seat->name =$request->input('name');
        $seat->email=$request->input('email');
        $seat->time = $request->input('time');
        $seat->seat=$request->input('seat');
        $seat->end_time=$request->input('end_time');
        $seat->save();
        return $this->response->noContent();
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
        $seat = Seat::find($id);
        $res = $seat->delete();
        return $this->response->noContent();
    }
    public function find($id){
        $seat = Seat::find($id);
        return $this->response->item($seat, new SeatTransformers());
    }
}

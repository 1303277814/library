<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SeatRequst;
use App\Models\Seat;
use Illuminate\Http\Request;

class SeatController extends BaseController
{
    /**
     * 处理传入的座位数据
     */
    public function store(SeatRequst $request){
        $seat = new Seat();
        $seat->name = $request->input('name');
        $seat->seat = $request->input('seat');
        $seat->email = $request->input('email');
        $seat->time = $request->input('time');
        $seat->end_time = $request->input('end_time');
        $seat->appointment = $request = 1;


        $seat->save();
        return $this->response->created();

    }
}

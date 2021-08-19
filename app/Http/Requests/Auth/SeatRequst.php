<?php


namespace App\Http\Requests\Auth;


use App\Http\Requests\BaseRequest;

class SeatRequst extends BaseRequest
{
    public function rules()
    {
        return [
            'name' =>'required|max:16|unique:library_seat',
            'seat'=>'required',
        ];
    }
}

<?php


namespace App\Transformers;


use App\Models\Seat;
use League\Fractal\TransformerAbstract;

class SeatTransformers extends TransformerAbstract
{
    public function transform(Seat $seat){

        return [
            'id' =>$seat->id,
            'name'=>$seat->name,
            'email'=>$seat->email,
            'seat'=>$seat->seat,
            'appointment' => $seat->appointment,
            'time' => $seat->time,
            'end_time' => $seat->end_time,

        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Seat extends Model implements JWTSubject
{
    use HasFactory;
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    //    1.关联的数据表
    public $table = 'library_seat';
    //2主键
    public $primaryKey ='id';
    //3.可以操作的字段
    public $fillable =[
        'name','email','seat','time',
    ];
//    4.不允许操作的字段
    public $guarded = [];
//        5.是否维护create_at 和updated_at字段
    public $timestamps = true;


}

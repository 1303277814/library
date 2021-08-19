<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformers extends TransformerAbstract
{
    /**
     * @param User $user
     * @return array
     * Transformers 允许你便捷地、始终如一地将对象转换为一个数组。通过使用一个transformer你可以对整数和布尔值，包括分页结果和嵌套关系进行类型转换。

     */
    public function transform(User $user){

            return [
                'id' =>$user->id,
                'name'=>$user->name,
                'email'=>$user->email
            ];
    }
}

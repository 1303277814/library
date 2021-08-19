<?php

namespace App\Http\Requests\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends BaseRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' =>'required|max:16|unique:library_user',
            'password'=>'required|min:4|max:16|confirmed',
            'email'=>'required|email|unique:library_user',

        ];
    }
}

<?php

namespace banruou\Http\Requests;

use banruou\Http\Requests\Request;

class UserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'txtUser'=>'required|unique:users,username',
            'txtPass'=>'required',
            'txtRePass'=>'required|same:txtPass',
            'txtEmail'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'txtUser.required'=>'Chưa nhập tên user',
            'txtUser.unique'=>'Tên user có người sử dụng rồi',
            'txtPass.required'=>'Chưa nhập mật khẩu',
            'txtRePass.required'=> 'Xác nhận mật khẩu lần nữa',
            'txtRePass.same'=> 'Xác nhận mật khẩu chưa đúng',
            'txtEmail.required'=> 'Chưa nhập email'
        ];
    }
}

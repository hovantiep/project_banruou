<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductRequest extends Request
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
//            'sltCate'=>'not_in:0',
//            'txtName'=>'required|unique:products,name',
//            'fImages'=>'required|image'
        ];
    }
    public function messages(){
        return [
            'sltCate.not_in' => 'Vui lòng chọn Category',
            'txtName.required'=>'Chưa nhập tên',
            'txtName.unique'=>'Tên này bị trùng',
            'fImages.required'=>'Chưa chọn hình',
            'fImages.image'=>'File không phải là hình ảnh',
        ];
    }
}

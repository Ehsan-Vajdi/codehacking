<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
            //
            'name' => 'required|max:30',
            'email' => 'required|email',
//            'role_id' => 'required',
            'is_active' => 'required',
            'password' => 'required|min:8|max:30',
            'photo_id' => 'image|max:2048|mimes:jpeg,png,jpg,gif,svg'
        ];
    }
}

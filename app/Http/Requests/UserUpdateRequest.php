<?php

namespace PCU\Http\Requests;

use PCU\Http\Requests\Request;
use PCU\User;

class UserUpdateRequest extends Request
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
        $user = User::find($this->users);
        
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'username' => 'required|max:45|unique:users,id,'.$user->id,
            'password' => 'max:60',
            'p_superadmin' => 'required_without_all:p_admin,p_document',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'p_superadmin.required_without_all'  => trans('strings.permissionsalert'),
        ];
    }
}

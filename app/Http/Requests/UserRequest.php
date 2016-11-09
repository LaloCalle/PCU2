<?php

namespace PCU\Http\Requests;

use PCU\Http\Requests\Request;

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
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'username' => 'required|unique:users|max:45',
            'password' => 'required|max:60',
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

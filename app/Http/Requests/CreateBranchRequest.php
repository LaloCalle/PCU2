<?php

namespace PCU\Http\Requests;

use PCU\Http\Requests\Request;

class CreateBranchRequest extends Request
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
            'branch_description' => 'required|min:5|max:255',
            'country' => 'required',
            'city' => 'required|min:3|max:255',
            'postal_code' => 'required|max:255',
            'colony' => 'required|max:255',
            'state' => 'required|max:255',
            'street' => 'required|min:5|max:255',
            'no_ext' => 'required|max:255',
            'no_int' => 'max:255',
            'email' => 'required|max:255|email',
            'phone' => 'required|max:255',
            'mobile' => 'max:255',
            'other' => 'max:255',
        ];
    }
}

<?php

namespace App\Http\Requests\Admins\Advisors;

use Illuminate\Foundation\Http\FormRequest;

class AddAdvisorRequest extends FormRequest
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
            'name' => ['required'],
            'username' => ['required',],
            'email' => ['email' , 'required'],
            'mobile' => [ 'required'],
            'password' => ['required', 'confirmed', ],
        ];
    }
}

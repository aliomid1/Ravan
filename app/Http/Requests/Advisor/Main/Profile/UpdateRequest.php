<?php

namespace App\Http\Requests\Advisor\Main\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
        // Rule::unique('users', 'email_address')->ignore($user->id),
        
        // $result = DB::table('users')->where( 'national_number' , Request::get('national_number'))->first();
        return [
            'name' => ['required'],
            'username' => ['required', Rule::unique('users', 'username')->ignore(auth()->user()) ],
            'email' => ['email' , 'required'],
            'mobile' => [ 'required'],
            'password' => ['confirmed',]
        ];
    }
}

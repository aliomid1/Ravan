<?php

namespace App\Http\Requests\Advisor\Main\Profile;

use Illuminate\Foundation\Http\FormRequest;

class VideoProfile extends FormRequest
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
            // Validate that an uploaded file is exactly 512 kilobytes...
            'video' => ['file' , 'max:14000']
        ];
    }
}

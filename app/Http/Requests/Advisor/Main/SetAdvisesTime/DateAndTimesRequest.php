<?php

namespace App\Http\Requests\Advisor\Main\SetAdvisesTime;

use Illuminate\Foundation\Http\FormRequest;

class DateAndTimesRequest extends FormRequest
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
            'Date' => ['required' , 'date' , 'date_format:Y/m/d'],
            'StartTime' => ['required', 'date_format:H:i' ],
            'EndTime' => ['required', 'date_format:H:i' ],
        ];
    }
}

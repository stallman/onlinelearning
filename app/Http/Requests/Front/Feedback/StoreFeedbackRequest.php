<?php

namespace App\Http\Requests\Front\Feedback;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeedbackRequest extends FormRequest
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
            'fullname' => 'string',
            'phone' => 'string|nullable',
            'email' => 'string|nullable',
            'question' => 'string|nullable',
        ];
    }
}

<?php

namespace App\Http\Requests\Admin\Block;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlockRequest extends FormRequest
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
            'order' => 'required|integer',
            'title' => 'required|string',
            'content' => 'nullable|string',
            'literature' => 'nullable|string',
        ];
    }
}

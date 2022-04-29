<?php

namespace App\Http\Requests\Admin\Import;

use Illuminate\Foundation\Http\FormRequest;

class TestImportRequest extends FormRequest
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
            'test_id' => 'required|integer',
            'file' => 'required|file|mimes:xlsx',
        ];
    }
}

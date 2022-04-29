<?php

namespace App\Http\Requests\Admin\Certificate;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCertificateRequest extends FormRequest
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
            'file' => 'nullable|mimes:pdf',
//            'number' => 'integer',
//            'scores' => 'numeric',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'Выберите файл сертификата',
        ];
    }
}

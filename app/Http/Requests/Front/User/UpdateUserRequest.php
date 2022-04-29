<?php

namespace App\Http\Requests\Front\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
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
            'surname' => 'required|string',
            'name' => 'required|string',
            'patronymic' => 'required|string',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'phone' => 'required|string',
            'job' => 'nullable|string',
//            'education_level' => 'nullable|string',
            'education_level_id' => 'nullable|exists:App\Models\EducationLevel,id',
            'speciality_id' => 'nullable|exists:App\Models\Speciality,id',
            'other_speciality' => 'nullable|string',
//            'certificate' => 'nullable|string',
//            'specialization_id' => 'nullable|exists:App\Models\Specialization,id',
//            'other_specialization' => 'nullable|string',
            'position' => 'nullable|string',
            'old_password' => 'nullable|string|current_password',
            'password' => 'nullable|required_with:old_password|string|confirmed',
        ];
    }
}

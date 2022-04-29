<?php

namespace App\Http\Requests\Admin\Course;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCourseRequest extends FormRequest
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
            'title' => 'required|string',
            'course_category_id' => 'required|exists:App\Models\CourseCategory,id',
            'is_home_visible' => 'boolean',
            'is_visible' => 'boolean',
            'is_anketable' => 'boolean',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'description' => 'required|string',
            'literature' => '',
            'user_id' => 'required|exists:App\Models\User,id',
            'teachers' => 'array',
            'users' => 'array',
            'specialities' => 'array',
            'test_id' => [
                'required',
                'exists:App\Models\Test,id',
                Rule::unique('courses', 'test_id')->ignore($this->course),
            ],
            'image' => 'file',
            'is_nmo_balls' => 'required|boolean',
            'is_has_certificate' => 'required|boolean',
            'duration' => 'required|integer',
            'education_level_id' => 'required|exists:App\Models\EducationLevel,id',
            'studyforms' => 'array',
            'price' => '',
            'content' => 'required|string',
            'program' => '',
            'files' => 'array',
        ];
    }
}

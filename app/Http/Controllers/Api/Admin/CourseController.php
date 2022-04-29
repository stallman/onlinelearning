<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function changeVisible(Request $request){
        $arData = $request->validate([
            'is_visible' => 'required|boolean',
            'course_id' => 'required',
        ]);

        Course::findOrFail($arData['course_id'])->update($arData);
        return response()->json($arData);
    }
}

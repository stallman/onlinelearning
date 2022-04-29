<?php

namespace App\Services\Front;

use App\Models\Course;
use App\Models\User;

class CourseService
{
    public function markCourseComplete(Course $obCourse, User $obUser){
        $obCourse->users()->updateExistingPivot($obUser->id, ['is_completed' => 1]);
    }
}

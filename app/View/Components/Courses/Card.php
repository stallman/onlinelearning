<?php

namespace App\View\Components\Courses;

use App\Models\Course;
use Illuminate\View\Component;

class Card extends Component
{

    public Course $obCourse;
    public bool $bIsProfile;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Course $obCourse, bool $bIsProfile = false)
    {
        $this->obCourse = $obCourse;
        $this->bIsProfile = $bIsProfile;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.courses.card');
    }
}

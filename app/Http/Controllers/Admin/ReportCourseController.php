<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\EducationLevel;
use App\Models\File;
use App\Models\Test;
use App\Models\User;
use App\Models\Speciality;
use App\Services\Admin\CourseService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Exports\CourseTestsExport;
use App\Http\Exports\CourseViewsExport;
use App\Http\Exports\CourseAnketaExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showResults()
    {
        $sPageTitle = 'Отчет о результатах. Выберете курс';
        $arCourses = Course::all();
        return view('admin.report.index', compact('sPageTitle', 'arCourses'));
    }

    public function showViews()
    {
        $sPageTitle = 'Отчет о посещении курса. Выберете курс';
        $arCourses = Course::all();
        return view('admin.report.index', compact('sPageTitle', 'arCourses'));
    }

    public function showAnketa()
    {
        $sPageTitle = 'Отчет об анкетировании. Выберете курс';
        $arCourses = Course::all();
        return view('admin.report.index', compact('sPageTitle', 'arCourses'));
    }

       
    public function exportResults($id)
    {
        $obCourse = Course::findOrFail($id);
        $filename = $obCourse->title.".  Результаты. ".date('Y-m-d H-i');

        ob_end_clean();
        return (new CourseTestsExport($id))->download($filename.'.xlsx', \Maatwebsite\Excel\Excel::XLSX);

    }

    public function exportViews($id)
    {
        $obCourse = Course::findOrFail($id);
        $filename = $obCourse->title.".  Визиты. ".date('Y-m-d H-i');

        ob_end_clean();
        return (new CourseViewsExport($id))->download($filename.'.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function exportAnketa($id)
    {
        $obCourse = Course::findOrFail($id);
        $filename = $obCourse->title.".  Анкеты. ".date('Y-m-d H-i');

        ob_end_clean();
        return (new CourseAnketaExport($id))->download($filename.'.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

}

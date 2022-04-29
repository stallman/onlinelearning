<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Course\StoreCourseRequest;
use App\Models\Block;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\EducationLevel;
use App\Models\StudyForm;
use App\Models\File;
use App\Models\Test;
use App\Models\User;
use App\Models\Anketa;
use App\Models\Speciality;
use App\Services\Admin\CourseService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sPageTitle = 'Все курсы';
        $arCourses = Course::all();
        return view('admin.courses.index', compact('sPageTitle', 'arCourses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $sPageTitle = 'Новый курс';
        $arCourseCategories = CourseCategory::all();
        $arCurators = User::role('curator')->get();
        $arTeachers = User::role('teacher')->get();
        $arTests = Test::all();
        $arEducationLevels = EducationLevel::all();
        $arSpecialities = Speciality::orderBy("name", "asc")->get();
        $arStudyForms = StudyForm::all();

        return view('admin.courses.form', compact('sPageTitle', 'arCourseCategories',
            'arCurators', 'arTeachers', 'arTests', 'arEducationLevels', 'arSpecialities', 'arStudyForms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCourseRequest $request
     * @param CourseService $obCourseService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCourseRequest $request, CourseService $obCourseService)
    {
        $arData = $request->validated();
        $arData['image'] = $request->file('image')->store('courses/images');

        $obCourse = new Course();
        $obCourse->fill($arData)->save();
        $obCourseService->storeOtherData($request, $arData, $obCourse);

        session()->flash('success', 'Курс успешно добавлен');

        return redirect()->route('admin.courses.index')->with('success', 'Курс успешно добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $obCourse = Course::findOrFail($id);
        $sPageTitle = 'Обновление курса';
        $arCourseCategories = CourseCategory::all();
        $arCurators = User::role('curator')->get();
        $arTeachers = User::role('teacher')->get();
        $arUsers = User::role('user')->get();
        $arTests = Test::all();
        $arSpecialities = Speciality::orderBy("name", "asc")->get();
        $arBlocks = $obCourse->blocks;

        $arEducationLevels = EducationLevel::all();
        $arStudyForms = StudyForm::all();
        return view('admin.courses.form', compact('sPageTitle', 'arCourseCategories',
            'arCurators', 'arTeachers', 'obCourse', 'arTests', 'arBlocks', 'arEducationLevels', 'arUsers', 'arSpecialities', 'arStudyForms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreCourseRequest $request
     * @param int $id
     * @param CourseService $obCourseService
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCourseRequest $request, int $id, CourseService $obCourseService)
    {
        $obCourse = Course::findOrFail($id);
        $arData = $request->validated();

        if(isset($arData['image']) && Storage::exists($obCourse->image)){
            $arData['image'] = $request->file('image')->store('courses/images');
            Storage::delete($obCourse->image);
        }

        $obCourse->update($arData);
        $obCourseService->storeOtherData($request, $arData, $obCourse);

        session()->flash('success', 'Курс успешно обновлен');

        return redirect()->route('admin.courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        Course::destroy($id);

        session()->flash('success', 'Курс успешно удалён');

        return redirect()->route('admin.courses.index');
    }

    /**
     * @param Request $request
     * @param Course $obCourse
     * @param User $obUser
     * @return \Illuminate\Http\RedirectResponse
     */
    public function detachUser(Request $request, Course $obCourse, User $obUser){
        $obCourse->users()->detach($obUser);
        $obCourse->test->users()->detach($obUser);
        $obUser->blocks()->detach($obCourse->blocks);
        $obUser->questions()->detach($obCourse->test->questions);
        Anketa::where('user_id',$obUser->id)->where('course_id', $obCourse->id)->delete();
        return back();
    }

    /**
     * @param Request $request
     * @param Course $obCourse
     * @return \Illuminate\Http\RedirectResponse
     */
    public function detachUsers(Request $request, Course $obCourse){
        
        $obCourse->users()->detach($request->users);
        $obCourse->test->users()->detach($request->users);
        foreach ($request->users as $iUserId){
            $obUser = User::find($iUserId);
            Anketa::where('user_id',$iUserId)->where('course_id', $obCourse->id)->delete();
            $obUser->blocks()->detach($obCourse->blocks);
            $obUser->questions()->detach($obCourse->test->questions);
        }
        return back();
    }

}

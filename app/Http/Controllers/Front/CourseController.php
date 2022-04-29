<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use App\Models\Block;
use App\Models\Course;
use App\Models\Speciality;
use App\Services\Front\BlockService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class CourseController extends Controller
{

    private BlockService $obBlockService;

    public function __construct(BlockService $obBlockService) {
        $this->obBlockService = $obBlockService;
    }

    public function index(Request $request) {

        $validator = Validator::make($request->all(), [
            'speciality' => 'required|numeric',
        ]);

        $arSpecialities = Speciality::orderBy("name", "asc")->get();

        if (!$validator->fails()) {

            $spec = $request->input('speciality');
            $arCoursesCount = Speciality::find($spec)->courses()->count();
            $arCourses = Speciality::find($spec)->courses()->paginate(Config::get('pagination.PAGES_COUNT'));

        } else {
            $arCoursesCount = Course::all()->count();
            $arCourses = Course::paginate(Config::get('pagination.PAGES_COUNT'));
        }

        return view('front.courses.index', compact('arSpecialities', 'arCourses', 'arCoursesCount'));
    }

    public function loadMore(Request $request) {

        $validator = Validator::make($request->all(), [
            'speciality' => 'required|numeric',
        ]);

        if (!$validator->fails()) {

            $spec = $request->input('speciality');
            $arCourses = Speciality::find($spec)->courses()->paginate(Config::get('pagination.PAGES_COUNT'));

        } else {
            $arCourses = Course::paginate(Config::get('pagination.PAGES_COUNT'));
        }

        return view('components.api-courses', compact('arCourses'));

    }



    public function detail(Course $obCourse){

        return view('front.courses.detail', compact('obCourse'));
    }

    public function webinars()
    {
        return view('front.courses.webinars');
    }

    public function activeCourses()
    {
        $obUser = Auth::user();
        $arCourses = $obUser->active_courses->orderBy("date_start", "desc")->get();

        return view('front.courses.active', compact('arCourses', ));
    }

    public function completedCourses()
    {
        $arCourses = Auth::user()->completed_courses->orderBy("date_end", "desc")->get();
        return view('front.courses.completed', compact('arCourses'));
    }

    public function availableCourses()
    {
        //получаем курсы, в которые нет текущий юзер не записан
        $arCourses = Course::whereDoesntHave('users', function (Builder $query) {
            $query->where('user_id', '=', Auth::id());
        })->get();

        return view('front.courses.available', compact('arCourses'));
    }

    public function show(Course $obCourse)
    {
        $obBlock = $obCourse->blocks->first();

        if(!$obBlock){
            $sActiveTab = 'show';
            $obCourse->setUserLastView();
            return view('front.courses.materials', compact('obCourse', 'sActiveTab'));
        }

        return redirect()->route('profile.courses.show.block',
            ['id' => $obCourse->id, 'blockId' => $obBlock->id]);
    }

    public function showBlock($id, $blockId)
    {
        $obCourse = Course::findOrFail($id);
        $obBlock = Block::findOrFail($blockId);
        $obBlock->users()->sync([Auth::id() => ['is_read' => true]]);
        $sActiveTab = 'show';
        $sPrevRoute = $this->obBlockService->getPrevRoute($obCourse, $obBlock);
        $sNextRoute = $this->obBlockService->getNextRoute($obCourse, $obBlock);
        return view('front.courses.materials', compact('obCourse', 'obBlock',
            'sActiveTab', 'sPrevRoute', 'sNextRoute'));
    }

    public function showBlockMaterials(Course $obCourse, Block $obBlock)
    {
        $sActiveTab = 'materials';
        $sPrevRoute = $this->obBlockService->getPrevRoute($obCourse, $obBlock);
        $sNextRoute = $this->obBlockService->getNextRoute($obCourse, $obBlock);
        $obCourse->setUserLastView();
        return view('front.courses.materials', compact('obCourse', 'obBlock',
            'sActiveTab', 'sPrevRoute', 'sNextRoute'));
    }


    public function showLiterature($id)
    {
        $obCourse = Course::findOrFail($id);
        $sActiveTab = 'literature';
        $obCourse->setUserLastView();
        $obBlock = $obCourse->blocks()->first();
        return view('front.courses.literature', compact('obCourse', 'sActiveTab', 'obBlock'));
    }
    public function showProgram(Course $obCourse)
    {
        $sActiveTab = 'program';
        $obBlock = $obCourse->blocks()->first();
        $obCourse->setUserLastView();
        return view('front.courses.program', compact('obCourse', 'sActiveTab', 'obBlock'));
    }

    public function showTeachers($id)
    {
        $obCourse = Course::findOrFail($id);
        $sActiveTab = 'teachers';
        $obCourse->setUserLastView();
        $obBlock = $obCourse->blocks()->first();
        return view('front.courses.teachers', compact('obCourse', 'sActiveTab', 'obBlock'));
    }

    public function attachUser(Course $obCourse){
        $obCourse->users()->attach(Auth::id());

        Auth::user()->blocks()->attach($obCourse->blocks);

        session()->flash('success', 'Вы успешно записались на курс');

        return redirect()->route('profile.courses.show', ['id' => $obCourse->id]);
    }

    /**
     * Сортировка и возрат активных курсов
    */
    public function sortActiveCurses(Request $request)
    {
        $sSort = $request->input('tipSort');
        $obUser = Auth::user();
        $arCourses = $obUser->active_courses->orderBy("date_start", $sSort)->get();
        $html = view('front.courses.active.table', compact('arCourses'))->render();
        return response()->json(compact('html'));
    }

    /**
     * Сортировка и возрат завершенных курсов
     */
    public function sortСompletedCurses(Request $request)
    {
        $sSort = $request->input('tipSort');
        $arCourses = Auth::user()->completed_courses->orderBy("date_end", $sSort)->get();
        $html = view('front.courses.completed.table', compact('arCourses'))->render();
        return response()->json(compact('html'));
    }
}

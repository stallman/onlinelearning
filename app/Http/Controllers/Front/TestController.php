<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Anketa;
use App\Services\Admin\TestService;
use App\Services\Front\CourseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Front\Test\StoreAnketaRequest;
use Illuminate\Support\Facades\Log; 

class TestController extends Controller
{

    public function start(Course $obCourse){

        if (!$obCourse->test->is_visible) {
            return view('front.tests.nonvisible',compact('obCourse'));
        }

        $afterAnketa = false;
        if ($obCourse->is_anketable) {
            $obUser = Auth::user();
            $obAnketa = Anketa::where('user_id', $obUser->id)->where('course_id', $obCourse->id)->get();
            if (!$obAnketa->first()) 
                return view('front.tests.anketa',compact('obCourse'));
            else $afterAnketa = true;
        }

        $bIsTestAvailable = true;
        if(count($obCourse->blocks) !== count(Auth::user()->getReadBlocks($obCourse->id))){
            $bIsTestAvailable = false;
        }

        $sActiveTab = '';

        $obUserCurrentTest = Auth::user()->getCurrentTest($obCourse->test->id);
        if(isset($obUserCurrentTest) && $obUserCurrentTest->pivot->is_started){
            return redirect()->route('profile.courses.test', ['obCourse' => $obCourse, 'questionNum' => 1]);
        }
        return view('front.tests.start', compact('obCourse', 'sActiveTab', 'bIsTestAvailable', 'afterAnketa'));
    }

    public function show(Request $request, TestService $obTestService, Course $obCourse, int $questionNum){

        if (!$obCourse->test->is_visible) {
            return view('front.tests.nonvisible',compact('obCourse'));
        }

        if($questionNum === 1){
            $obTestService->markTestStart($obCourse->test->id);
        }

        if($obTestService->isTimeExpired($obCourse)){
            return redirect()->route('profile.courses.test.complete', ['obCourse' => $obCourse]);
        }

        $iAnsweredCount = 0;
        if($request->isMethod('post')){
            $arData = $request->all();
            $bIsAnswerRight = $obTestService->checkUserAnswerIsRight($arData['question_id'], $arData['answer']);
            $obTestService->storeSelectedAnswers($arData['answer'], $arData['question_id'], $arData['question_type']);
            $obTestService->storeQuestionResult($arData['question_id'], $bIsAnswerRight);
        }else{
            //редирект на последний вопрос на который ответил пользователь
            foreach($obCourse->test->questions as $obQ){
                if(!isset($obQ->answered)){
                    if($questionNum === $obQ->order){
                        break;
                    }
                    return redirect()->route('profile.courses.test', ['obCourse' => $obCourse, 'questionNum' => $obQ->order]);
                }else{
                    $iAnsweredCount++;
                }
            }
        }

        $sActiveTab = '';
        $obQuestion = $obCourse->test->questions()->where('order', $questionNum)->first();

        if($obQuestion === null || $iAnsweredCount === (count($obCourse->test->questions))){
            return redirect()->route('profile.courses.test.complete', ['obCourse' => $obCourse]);
        }
        $mEndedAt = Auth::user()->getCurrentTest($obCourse->test->id)->pivot->created_at;
        return view('front.tests.show', compact('obCourse', 'sActiveTab', 'obQuestion'));
    }

    public function complete(Course $obCourse, TestService $obTestService, CourseService $obCourseService){
        if (!$obCourse->test->is_visible) {
            return view('front.tests.nonvisible',compact('obCourse'));
        }

        $sActiveTab = '';

        $obTestService->markTestComplete($obCourse->test->id);
        $iResult = $obCourse->test_results;
        if($iResult >= $obCourse->test->minimal_right_questions){
            $obCourseService->markCourseComplete($obCourse, Auth::user());
        }else{
            $obCourse->users()->updateExistingPivot(Auth::id(), ['is_completed' => 0]);
        }

        return view('front.tests.complete', compact('obCourse', 'sActiveTab', 'iResult'));
    }

    public function resetTest(Course $obCourse){
        $obUser = Auth::user();
        $obUser->questions()->detach($obCourse->test->questions);
        $obCourse->test->users()->detach($obUser);

        return redirect()->route('profile.courses.test.start', $obCourse);
    }

    public function anketa(StoreAnketaRequest $request,Course $obCourse){

        $obUser = Auth::user();
        $arData = $request->validated();
        $arData['user_id'] = $obUser->id;
        $arData['course_id'] = $obCourse->id;
        if (isset($arData['q5'])) $arData['q5'] = implode('; ',$arData['q5']);


        Anketa::create($arData);
        return redirect()->route('profile.courses.test.start', $obCourse); 
    }
}

<?php

namespace App\Services\Admin;

use App\Models\Answer;
use App\Models\Course;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Boolean;

class TestService
{
    /**
     * Проверка правильности ответов
     * @param int $iQuestionId
     * @param $mAnswer
     * @return bool|null
     */
    public function checkUserAnswerIsRight(int $iQuestionId, $mAnswer): ?bool
    {
        $obQuestion = Question::findOrFail($iQuestionId);
        $sQuestionType = $obQuestion->type;
        switch ($sQuestionType) {
            case Question::TYPES['one']['type']:
                return Answer::select(['id', 'is_right'])->findOrFail($mAnswer)->is_right;

            case Question::TYPES['several']['type']:
                $arAnswers = $obQuestion->answers()->where('is_right', true)->pluck('id')->toArray();
                if($arAnswers == $mAnswer){
                    return true;
                }
                return false;

            case Question::TYPES['text']['type']:
                return null;

            case Question::TYPES['right_order']['type']:
                $arRightAnswers = $obQuestion->answers()->orderBy('right_order')->pluck('id')->toArray();
                if($arRightAnswers == $mAnswer){
                    return true;
                }
                return false;

            default:
                abort(404);
        }
    }

    /**
     * Проверка времени выделенного на тестирование
     * @param Course $obCourse
     */
    public function isTimeExpired(Course $obCourse): bool
    {
        $mEndedAt = Auth::user()->getCourseTestEndedDate($obCourse);
        $mCurrentDate = Carbon::now();
        if($mEndedAt->greaterThan($mCurrentDate)){
            return false;
        }
        return true;
    }

    public function storeQuestionResult(int $iQuestionId, ?bool $bIsRight)
    {
        $obUser = Auth::user();
        if ($obUser->questions()->where('question_id', '=', $iQuestionId)->first() !== null) {
            $obUser->questions()->detach($iQuestionId);
        }
        $obUser->questions()->attach($iQuestionId, ['is_right' => $bIsRight]);
    }

    public function storeSelectedAnswers($mAnswer, int $iQuestionId, string $sQuestionType)
    {
        $obUser = Auth::user();
        $arAnswerIds = Question::findOrFail($iQuestionId)->answers()->pluck('id')->toArray();
        $obUser->answers()->detach($arAnswerIds);//удаляем все выделенные ответы из таблицы чтобы потом по новой их привязать
        switch ($sQuestionType) {
            case Question::TYPES['one']['type']:
            case Question::TYPES['several']['type']:
            case Question::TYPES['right_order']['type']:
                $obUser->answers()->attach($mAnswer, ['question_id' => $iQuestionId]);
                break;
            case Question::TYPES['text']['type']:
                DB::table('answer_user')->insert([
                    'question_id' => $iQuestionId,
                    'answer_id' => null,
                    'user_id' => $obUser->id,
                    'text' => $mAnswer,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                break;
            default:
                abort(404);
        }
    }

    public function markTestStart(int $iTestId){
        $obUser = Auth::user();
        $obUserCurrentTest = Auth::user()->getCurrentTest($iTestId);
        if(!isset($obUserCurrentTest)){
            $obUser->tests()->detach($iTestId);
            $obUser->tests()->attach($iTestId, ['is_started' => true]);
        }
    }

    public function markTestComplete(int $iTestId){
        $obUser = Auth::user();
        $obUser->tests()->updateExistingPivot($iTestId, ['is_completed' => true]);
    }
}

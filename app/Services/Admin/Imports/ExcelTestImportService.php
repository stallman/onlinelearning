<?php

namespace App\Services\Admin\Imports;

use App\Models\Answer;
use App\Models\Question;
use App\Services\Interfaces\Admin\Imports\TestImportServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class ExcelTestImportService implements TestImportServiceInterface
{

    /**
     * Читает табличку xlsx формата и возвращает массив строк этой таблицы
     * @param string $sPath
     * @return array
     */
    private function readXlsx(string $sPath) : array
    {
        $obReader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $obReader->setReadDataOnly(true);
        $obReader->setReadEmptyCells(false);
        $obTable = $obReader->load($sPath)->getActiveSheet();

        return $obTable->toArray();
    }

    /**
     * Преобразует массив строк таблицы в массив, где ключами являются тексты вопроса,
     * а значениями массив с текстом ответа и верностью данного ответа
     * @param array $arRawData
     * @return array
     */
    private function transformRawData(array $arRawData) : array
    {
        $arResult = [];
        foreach($arRawData as $arRow){
            if($arRow[0] === null || mb_strtolower($arRow[0]) === 'вопрос'){
                continue;
            }
            $sQuestion = $arRow[0];
            $arAnswer = [];
            $arAnswer['answer'] = $arRow[1];
            $arAnswer['is_right'] = $arRow[2] === 'Y';

            $arResult[$sQuestion][] = $arAnswer;
        }

        return $arResult;
    }

    public function import(UploadedFile $obFile, int $iTestId)
    {
        $arRawData = $this->readXlsx($obFile->getPathname());
        $arQuestionAnswers = $this->transformRawData($arRawData);
        $arQuestions = array_keys($arQuestionAnswers);
        try {
            DB::transaction(function() use ($arQuestionAnswers, $iTestId) {
                $arQuestionsImportData = [];
                $arAnswersImportData = [];
                $obLastQuestion = Question::where('test_id', '=', $iTestId)->orderBy('order', 'desc')->first();
                $iQuestionLastOrder = $obLastQuestion ? $obLastQuestion->order : 0;

                $iQuestionLastId = (int)Question::orderBy('id', 'desc')->first()->id;

                foreach ($arQuestionAnswers as $sQuestion => $arAnswers){
                    $iQuestionLastOrder++;
                    $iQuestionLastId++;
                    $arQuestionsImportData[] = [
                        'id' => $iQuestionLastId,
                        'text' => $sQuestion,
                        'test_id' => $iTestId,
                        'type' => 'one',
                        'order' => $iQuestionLastOrder,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    foreach ($arAnswers as $arAnswer){
                        $arAnswersImportData[] = [
                            'text' => $arAnswer['answer'],
                            'question_id' => $iQuestionLastId,
                            'is_right' => $arAnswer['is_right'],
                            'right_order' => null,
                        ];
                    }
                }
                Question::insert($arQuestionsImportData);
                Answer::insert($arAnswersImportData);
            }, 3);
        }catch(\Exception $e){
            dd($e);
            DB::rollback();
        }
    }
}

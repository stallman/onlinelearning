<?php

namespace App\Http\Middleware\Admin\Test;

use App\Models\Question;
use Closure;
use Illuminate\Http\Request;

class AnswerCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->isMethod('post')){
            $arData = $request->all();
            if($arData['question_type'] === Question::TYPES['one']['type']
                || $arData['question_type'] === Question::TYPES['several']['type']
                || $arData['question_type'] === Question::TYPES['text']['type']){
                if(!isset($arData['answer'])){
                    return back()->withErrors(['msg' => 'Ответ на вопрос не может быть пустым']);
                }
            }else if($arData['question_type'] === Question::TYPES['right_order']['type']){
                foreach ($arData['answer'] as $iAnswer){
                    if($iAnswer === '0'){
                        return back()->withErrors(['msg' => 'Замечены пустые поля']);
                    }
                }
            }
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Controllers\Admin\Tests;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Promise\all;

class TestVerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sPageTitle = 'Список текстовых ответов';
        $arData = DB::table('questions')->where('type', '=', 'text')
            ->join('answer_user', 'questions.id', '=', 'answer_user.question_id')
            ->join('tests', 'questions.test_id', '=', 'tests.id')
            ->get(['user_id', 'tests.title', 'answer_user.text', 'answer_user.created_at', 'question_id', 'answer_user.id']);
        return view('admin.tests.verification.text.index', compact('sPageTitle', 'arData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd('sds');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd('sds');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('sds');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sPageTitle = 'Просмотр ответа';
        $obAnswer = DB::table('answer_user')->where('answer_user.id', '=', $id)
            ->join('questions', 'answer_user.question_id', '=', 'questions.id')
            ->join('question_user', function ($join) {
                $join->on('answer_user.question_id', '=', 'question_user.question_id')
                    ->on('question_user.user_id', '=', 'answer_user.user_id');
            })
            ->first(['answer_user.id', 'answer_user.text', 'answer_user.user_id',
                'question_user.is_right', 'answer_user.question_id']);

        return view('admin.tests.verification.text.form', compact('sPageTitle', 'obAnswer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $obAnswer = DB::table('answer_user')->where('answer_user.id', '=', $id)
            ->join('question_user', function ($join) {
                $join->on('answer_user.question_id', '=', 'question_user.question_id')
                    ->on('question_user.user_id', '=', 'answer_user.user_id');
            })
            ->first(['question_user.id']);

        DB::table('question_user')
            ->where('id','=', $obAnswer->id)
            ->update(['is_right' => $request->is_right]);

        session()->flash('success', "Оценка успешно записана");

        return redirect()->route('admin.tests.verification.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd('sds');
    }
}

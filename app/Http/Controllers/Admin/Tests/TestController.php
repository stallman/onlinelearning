<?php

namespace App\Http\Controllers\Admin\Tests;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Test\StoreTestRequest;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sPageTitle = 'Все тесты';
        $arTests = Test::all();
        return view('admin.tests.index', compact('sPageTitle', 'arTests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sPageTitle = 'Новый тест';
        return view('admin.tests.form', compact('sPageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTestRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTestRequest $request)
    {
        Test::create($request->validated());

        session()->flash('success', "Тест {$request->title} добавлен");

        return redirect()->route('admin.tests.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sPageTitle = 'Редактировать тест';
        $obTest = Test::findOrFail($id);
        $arTestTypes = Question::TYPES;
        $arQuestions = $obTest->questions;
        return view('admin.tests.form', compact('sPageTitle', 'obTest', 'arTestTypes', 'arQuestions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Test $test
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTestRequest $request, Test $test)
    {
        $test->update($request->all());

        return redirect()->route('admin.tests.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Test::destroy($id);

        return back();
    }
}

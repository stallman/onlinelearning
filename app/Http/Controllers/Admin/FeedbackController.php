<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Feedback\StoreFeedbackRequest;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sPageTitle = 'Все отзывы';
        $arNews = Feedback::orderBy("created_at", "desc")->get();
        return view('admin.feedback.index', compact('sPageTitle', 'arNews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sPageTitle = 'Просмотр отзыва';
        $obFeedback = Feedback::findOrFail($id);
        return view('admin.feedback.form', compact('sPageTitle', 'obFeedback'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Feedback $feedback, StoreFeedbackRequest $request)
    {
        try{
            $data = $request->validated();
            $feedback->update($data);
            session()->flash('success', "Пост #{$feedback->id} обновлён");
        }
        catch (Exception $e)
        {
            session()->flash('success', "Не удалось обновить пост #{$feedback->id}");
        }
        return redirect()->route('admin.feedback.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return redirect()->route('admin.feedback.index');
    }
}

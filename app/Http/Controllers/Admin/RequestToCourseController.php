<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RequestToCourse;
use Illuminate\Http\Request;

class RequestToCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sPageTitle = 'Все заявки на курсы';
        $arRequests = RequestToCourse::all();
        return view('admin.requests_to_courses.index', compact('sPageTitle', 'arRequests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sPageTitle = 'Просмотр заявки';
        $obRequest = RequestToCourse::findOrFail($id);
        return view('admin.requests_to_courses.form', compact('sPageTitle', 'obRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param RequestToCourse $requestToCourse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequestToCourse $requestToCourse)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RequestToCourse::destroy($id);

        return back();

    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Speciality\StoreSpecialityRequest;
use App\Models\EducationLevel;
use App\Models\Speciality;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sPageTitle = 'Все специальости';
        $arSpeciality = Speciality::all();
        return view('admin.speciality.index', compact('sPageTitle', 'arSpeciality'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sPageTitle = 'Новая специальность';
        $arEducationLevel = EducationLevel::all(['id', 'name']);
        return view('admin.speciality.form', compact('sPageTitle', 'arEducationLevel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSpecialityRequest $request)
    {
        Speciality::create($request->validated());

        session()->flash('success', "Специальность {$request->name} добавлена");

        return redirect()->route('admin.speciality.index');
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
        $sPageTitle = 'Редактировать специальность';
        $obSpeciality = Speciality::findOrFail($id);
        $arEducationLevel = EducationLevel::all(['id', 'name']);
        return view('admin.speciality.form', compact('sPageTitle', 'obSpeciality', 'arEducationLevel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSpecialityRequest $request, Speciality $speciality)
    {
        $speciality->update($request->validated());

        session()->flash('success', "Специальность {$request->name} обновлена");

        return redirect()->route('admin.speciality.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Speciality::destroy($id);

        session()->flash('success', "Специальность удалена");

        return redirect()->route('admin.speciality.index');
    }
}

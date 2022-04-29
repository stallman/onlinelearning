<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Specialization\StoreSpecializationRequest;
use App\Models\Specialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sPageTitle = 'Все специализации';
        $arSpecializations = Specialization::all();
        return view('admin.specializations.index', compact('sPageTitle', 'arSpecializations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sPageTitle = 'Новая специализация';
        return view('admin.specializations.form', compact('sPageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSpecializationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSpecializationRequest $request)
    {
        Specialization::create($request->validated());

        session()->flash('success', "Специализация {$request->name} добавлена");

        return redirect()->route('admin.specializations.index');
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
        $sPageTitle = 'Редактировать специализацию';
        $obSpecialization = Specialization::findOrFail($id);
        return view('admin.specializations.form', compact('sPageTitle', 'obSpecialization'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreSpecializationRequest $request
     * @param Specialization $specialization
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSpecializationRequest $request, Specialization $specialization)
    {
        $specialization->update($request->validated());

        session()->flash('success', "Специализация {$request->name} обновлена");

        return redirect()->route('admin.specializations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Specialization::destroy($id);

        session()->flash('success', "Специализация удалена");

        return redirect()->route('admin.specializations.index');

    }
}

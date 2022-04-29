<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Testing\Fluent\Concerns\Has;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sPageTitle = 'Все преподаватели';
        $arUsers = User::role('teacher')->get();
        return view('admin.users.teachers.index', compact('sPageTitle', 'arUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sPageTitle = 'Новый преподаватель';
        return view('admin.users.teachers.form', compact('sPageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $arData = $request->all();
        $arData['password'] = Hash::make('teacher_password');

        if($request->file('image')){
            $arData['image'] = $request->file('image')->store('users/teachers');
        }else{
            $arData['image'] = '';
        }


        $obUser = new User();
        $obUser->fill($arData)->save();

        $obUser->update([
            'password' => Hash::make("teacher_password_{$obUser->id}"),
        ]);

        $obUser->assignRole('teacher');

        return redirect()->route('admin.teachers.index');
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
        $sPageTitle = 'Редактировать преподавателя';
        $obUser = User::findOrFail($id);
        return view('admin.users.teachers.form', compact('sPageTitle', 'obUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $arData = $request->all();
        $obUser = User::findOrFail($id);
        if(isset($request->image)){
            $arData['image'] = $request->file('image')->store('users/teachers');
            Storage::delete($obUser->image);
        }

        $obUser->update($arData);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        User::destroy($id);

        return back();
    }
}

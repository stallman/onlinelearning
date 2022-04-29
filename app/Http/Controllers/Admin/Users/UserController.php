<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Anketa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sPageTitle = 'Все пользователи';
        $arUsers = User::role('user')->get();
        return view('admin.users.users.index', compact('sPageTitle', 'arUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sPageTitle = 'Новый пользователь';
        $arCourses = Course::all();
        return view('admin.users.users.form', compact('sPageTitle', 'arCourses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arData = $request->validate([
            'surname' => 'required|string',
            'name' => 'required|string',
            'patronymic' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            'courses' => 'array',
        ]);

        $arData['password'] = Hash::make($arData['password']);

        $obUser = new User();
        $obUser->fill($arData)->save();
        $obUser->assignRole('user');

        if(isset($arData['courses'])){
            foreach ($arData['courses'] as $iCourseId){
                $obCourse = Course::find($iCourseId);
                $obCourse->users()->attach($obUser->id);
                $obUser->blocks()->attach($obCourse->blocks);
            }
        }

        return redirect()->route('admin.users.index');
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
        $sPageTitle = 'Редактировать пользователя';
        $obUser = User::findOrFail($id);
        $arCourses = Course::all();
        return view('admin.users.users.form', compact('sPageTitle', 'obUser', 'arCourses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $obUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $arData = $request->validate([
            'surname' => 'required|string',
            'name' => 'required|string',
            'patronymic' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string',
            'courses' => 'array',
        ]);
        $obUser = User::findOrFail($id);
        if(isset($arData['password'])){
            $arData['password'] = Hash::make($arData['password']);
        }else{
            unset($arData['password']);
        }

        if(isset($arData['courses'])){

            foreach ($arData['courses'] as $iCourseId){
                $obCourse = Course::find($iCourseId);
                $obCourse->users()->attach($id);
                $obUser->blocks()->attach($obCourse->blocks);
            }

        }

        $obUser->update($arData);

        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);

        return back();
    }

    public function detachCourse(Request $request, User $obUser, Course $obCourse){
        $obCourse->users()->detach($obUser);
        $obCourse->test->users()->detach($obUser);
        $obUser->blocks()->detach($obCourse->blocks);
        $obUser->questions()->detach($obCourse->test->questions);
        Anketa::where('user_id',$obUser->id)->where('course_id', $obCourse->id)->delete();
        return back();
    }

}

<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CuratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sPageTitle = 'Все кураторы';
        $arUsers = User::role('curator')->get();
        return view('admin.users.curators.index', compact('sPageTitle', 'arUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sPageTitle = 'Новый куратор';
        return view('admin.users.curators.form', compact('sPageTitle'));
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
        $arData['password'] = Hash::make('curator_password');

        if($request->file('image')){
            $arData['image'] = $request->file('image')->store('users/curators');
        }else{
            $arData['image'] = '';
        }

        $obUser = new User();
        $obUser->fill($arData)->save();

        $obUser->update([
            'password' => Hash::make("curator_password_{$obUser->id}"),
        ]);

        $obUser->assignRole('curator');

        return redirect()->route('admin.curators.index');
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
        $sPageTitle = 'Редактировать куратора';
        $obUser = User::findOrFail($id);
        return view('admin.users.curators.form', compact('sPageTitle', 'obUser'));
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
            $arData['image'] = $request->file('image')->store('users/curator');
            if($obUser->image){
                Storage::delete($obUser->image);
            }
        }
        if($request->is_image_delete){
            if($obUser->image){
                Storage::delete($obUser->image);
            }
            $arData['image'] = '';
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

<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\User\UpdateUserRequest;
use App\Http\Requests\Front\User\UploadImageRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function update(UpdateUserRequest $request){
        $arDataForUpdate = $request->validated();

//        dd($arDataForUpdate);

        if (isset($arDataForUpdate['other_speciality']) && empty($arDataForUpdate['speciality_id']))
        {
            $arDataForUpdate['speciality_id'] = null;
        }

        if (isset($arDataForUpdate['speciality_id']) && empty($arDataForUpdate['other_speciality']))
        {
            $arDataForUpdate['other_speciality'] = null;
        }

        if (empty($arDataForUpdate['other_speciality']) && empty($arDataForUpdate['speciality_id']))
        {
            $arDataForUpdate['other_speciality'] = null;
            $arDataForUpdate['speciality_id'] = null;
        }

//        dd($arDataForUpdate);
        $sNewPassword = $arDataForUpdate['password'];
        if($sNewPassword){
            $arDataForUpdate['password'] = Hash::make($sNewPassword);
        }else{
            unset($arDataForUpdate['password']);
        }

        $obUser = User::findOrFail(Auth::id());
        $obUser->update($arDataForUpdate);

        session()->flash('success', 'Информация успешно изменена');

        return redirect()->route('profile.home');

    }
    public function uploadImage(UploadImageRequest $request){
        $arData = $request->all();

        $arData['image'] = $request->file('image')->store('users/images');

        $obUser = User::findOrFail(Auth::id());

        if($obUser->image && Storage::exists($obUser->image)){
            Storage::delete($obUser->image);
        }

        $obUser->update($arData);

        session()->flash('success', 'Ваш аватар обновлён');

        return redirect()->route('profile.home');
    }
}

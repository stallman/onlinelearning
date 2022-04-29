<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Speciality;
use App\Models\EducationLevel;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
        $obUser = Auth::user();
        $arSpecializations = Specialization::all(['id', 'name']);
//        $arSpeciality = Speciality::where('education_level_id', '=', $obUser->education_level_id)->get();
        $arSpeciality = Speciality::orderBy('name')->get();
        $arEducationLevel = EducationLevel::all(['id', 'name']);
        return view('front.profile.index', compact('obUser', 'arSpecializations', 'arSpeciality', 'arEducationLevel'));
    }

    public function getSpecialty(Request $request)
    {
        $id = $request->input('value');
        $arSpeciality = Speciality::where('education_level_id', '=', $id)->get();
        return response()->json($arSpeciality);
    }
}

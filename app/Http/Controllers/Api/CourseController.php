<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Speciality;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __invoke(Request $request) {
    
        $validated = $request->validate([
            'speciality' => 'required|numeric',
        ]); 

        $spec = $request->input('speciality');
        $uriSegments = explode("/", parse_url($request->headers->get('referer'), PHP_URL_PATH));
        

        if (!isset($uriSegments[1])) {
            $arCourses = Speciality::find($spec)->courses()->where('is_home_visible','1')->limit(3)->get();
            return view('components.api-courses', compact('arCourses'));
        } else {
            $arCourses = Speciality::find($spec)->courses()->paginate(Config::get('pagination.PAGES_COUNT'));
            return view('components.api-courses', compact('arCourses'));
        }
//        $arNewsCount = News::get()->count();
//        $arAllNews = News::orderBy("created_at", "desc")->paginate(6);

//        return view('front.news.index', compact('arAllNews', 'arNewsCount'));


                                 
//        return $arCourses->toJson();

    }
}

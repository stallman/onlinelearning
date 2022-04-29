<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Question;
use App\Models\User;
use App\Models\News;
use App\Models\Course;
use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Captcha;

class HomeController extends Controller
{
    public function index(){
        $arForBanners = Banner::find([13, 14, 15]);
        $arInfoBanners = Banner::find([16, 17, 18]);
        $arLastNews = News::orderBy("created_at", "desc")->offset(0)->limit(3)->get();
        $arCourses = Course::where('is_home_visible', '=', '1')->limit(3)->get();
        $arSpecialities = Speciality::orderBy("name", "asc")->get();

        $captcha = Captcha::chars('123456789ABCDEFGHIJKLMNPQRSTUVWXYZ')->generate();

        return view('front.index', compact('arForBanners', 'arInfoBanners', 'arLastNews', 'captcha', 'arCourses','arSpecialities'));
    }
}

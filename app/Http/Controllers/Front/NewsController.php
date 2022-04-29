<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $arNewsCount = News::get()->count();
        $arAllNews = News::orderBy("created_at", "desc")->paginate(Config::get('pagination.PAGES_COUNT'));
        return view('front.news.index', compact('arAllNews', 'arNewsCount'));
    }


    public function loadMore() {

        $arAllNews = News::orderBy("created_at", "desc")->paginate(Config::get('pagination.PAGES_COUNT'));
        if ($arAllNews)
        return view('components.news.loadmore', compact('arAllNews'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $obNews = News::findOrFail($id);
        $arOtherNews = News::orderBy("created_at", "desc")->where('id','<>',$id)->offset(0)->limit(3)->get();
        return view('front.news.show', compact('obNews', 'arOtherNews'));
    }

}

<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Search\HandleSearchRequest;
use App\Models\Course;
use App\Models\News;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SearchController extends Controller
{
    public function index(){
        return view('front.search.index');
    }

    public function handle(HandleSearchRequest $request, int $iPage){
        $arData = $request->validated();
        if(mb_strlen($arData['search']) >= 6 ){
            $sSearchString = mb_substr($arData['search'], 0, -2);
        }else{
            $sSearchString = $arData['search'];
        }

        $arNews = News::where('title', 'like', "%{$sSearchString}%")->orWhere('content', 'like', "%{$sSearchString}%")->get();
        $arCourses = Course::where('title', 'like', "%{$sSearchString}%")
            ->orWhere('content', 'like', "%{$sSearchString}%")
            ->orWhere('description', 'like', "%{$sSearchString}%")
            ->get();

        $sSearchString = $arData['search'];

        $arResult = new Collection();
        $arResult = collect($arResult)->merge($arNews);
        $arResult = collect($arResult)->merge($arCourses);
        $sFilterType = $arData['filter'] ?? 'date';
        if(!$sFilterType || $sFilterType === 'date'){
            $arResult = $arResult->sortBy([
                fn ($a, $b) => -($a['updated_at'] <=> $b['updated_at']),
            ]);
        }else if($sFilterType === 'relevant'){
            $arResult = $arResult->sortBy([
                fn ($a, $b) => mb_substr_count($a->getContentForSearch(), $sSearchString)
                    <=>  mb_substr_count($b->getContentForSearch(), $sSearchString),
            ]);
        }

        $iResultPerPage = 5;
        $iResults = count($arResult);
        $arResultOnPage = $arResult->forPage($iPage, $iResultPerPage);
        $iPages = (int)ceil(count($arResult->toArray()) / $iResultPerPage);

        return view('front.search.index', compact('iPage', 'arResultOnPage', 'sSearchString', 'iPages', 'iResults', 'sFilterType'));
    }
}

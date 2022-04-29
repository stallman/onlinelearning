<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Http\Requests\Admin\News\StoreNewsRequest;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sPageTitle = 'Все новости';
        $arNews = News::all();
        return view('admin.news.index', compact('sPageTitle', 'arNews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sPageTitle = 'Создать новость';
        return view('admin.news.form', compact('sPageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsRequest $request)
    {
//        dd($request);
        $data = $request->validated();

        if ($request->file('image') !== null)
        {
            $data['image'] = $request->file('image')->store('news/images');
            News::create($data);
            session()->flash('success', "Новость {$data['title']} добавлена");
        }
        else
        {
            $data['image'] =  "default";
            News::create($data);
            session()->flash('success', "Новость {$data['title']} добавлена");
        }


        return redirect()->route('admin.news.index');
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
        $sPageTitle = 'Редактировать пост';
        $obNews = News::findOrFail($id);
        return view('admin.news.form', compact('sPageTitle', 'obNews'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(News $news, StoreNewsRequest $request)
    {
        $data = $request->validated();
        if ($request->file('image') !== null)
        {
            $data['image'] = $request->file('image')->store('banners/images');
            $news->update($data);
            session()->flash('success', "Пост #{$news->id} обновлён");
        }
        else if (isset($data['image_old']))
        {
            $data['image'] =  $data['image_old'];
            $news->update($data);
            session()->flash('success', "Пост #{$news->id} обновлён");
        }
        else
        {
            $data['image'] =  "default";
            $news->update($data);
            session()->flash('success', "Пост #{$news->id} обновлён");
        }

        return redirect()->route('admin.news.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
//        dd($news->image);
        if ($news->image !== "default")
            unlink(public_path('storage/'.$news->image));
        $news->delete();
        return redirect()->route('admin.news.index');
    }
}

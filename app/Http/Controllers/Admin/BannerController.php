<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Banner\StoreBannerRequest;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sPageTitle = 'Все банеры';
        $arBanners = Banner::all();
        return view('admin.banners.index', compact('sPageTitle', 'arBanners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sPageTitle = 'Новый баннер';
        return view('admin.banners.form', compact('sPageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBannerRequest $request)
    {
        $data = $request->validated();

        if ($request->file('image') !== null)
        {
            $data['image'] = $request->file('image')->store('banners/images');
        }

        Banner::create($data);
        session()->flash('success', "Баннер {$data['title']} добавлен");
        return redirect()->route('admin.banners.index');
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
        $sPageTitle = 'Редактировать баннер';
        $obBanner = Banner::findOrFail($id);
        return view('admin.banners.form', compact('sPageTitle', 'obBanner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Banner $banner, StoreBannerRequest $request)
    {
        $data = $request->validated();
        $bdData = [
            'title' => $data["title"],
            'content' =>  $data["content"],
            'is_published' =>  $data["is_published"],
        ];

        if ($request->file('image') !== null)
        {
            $data['image'] = $request->file('image')->store('banners/images');
            $bdData['image'] = $data['image'];
        }
        else
        {
            $bdData['image'] =  $data['image_old'];
        }
        $banner->update($bdData);
        session()->flash('success', "Баннер #{$banner->id} обновлён");
        return redirect()->route('admin.banners.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        unlink(public_path('storage/'.$banner->image));
        $banner->delete();
        return redirect()->route('admin.banners.index');
    }
}

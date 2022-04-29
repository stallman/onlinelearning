<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Block\StoreBlockRequest;
use App\Models\Block;
use App\Models\File;
use App\Services\Admin\BlockService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBlockRequest $request
     * @param BlockService $obBlockService
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlockRequest $request, BlockService $obBlockService)
    {
        $obBlock = new Block();
        $obBlock->fill($request->all())->save();
        $obBlockService->storeAnotherData($request, $obBlock);

        return back();
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Block $block
     * @param BlockService $obBlockService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Block $block, BlockService $obBlockService)
    {
        $block->update($request->all());
        $obBlockService->storeAnotherData($request, $block);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Block::destroy($id);
        return back();
    }
}

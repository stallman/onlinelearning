<?php


namespace App\Services\Admin;


use App\Models\Block;
use App\Models\File;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BlockService
{
    public function storeAnotherData(Request $request, Block $obBlock){
        if(is_array($request->file('materials'))){
            $arMaterialsData = [];
            $sNow = Carbon::now()->toDateTimeString();
            foreach ($request->file('materials') as $sKey => $mFile){
                $arMaterialsData[] = [
                    'type' => 'material',
                    'path' => $mFile->store('blocks/materials'),
                    'name' => $mFile->getClientOriginalName(),
                    'created_at' => $sNow,
                    'updated_at' => $sNow,
                ];
            }
            File::insert($arMaterialsData);
            $arMaterialsIds = File::where('created_at', '=', $sNow)->get();
            $obBlock->files()->syncWithoutDetaching($arMaterialsIds);
        }

        if(is_array($request->file('presentations'))){
            $arPresentationsData = [];
            $sNow = Carbon::now()->toDateTimeString();
            foreach ($request->file('presentations') as $sKey => $mFile){
                $arPresentationsData[] = [
                    'type' => 'presentation',
                    'path' => $mFile->store('blocks/presentations'),
                    'name' => $mFile->getClientOriginalName(),
                    'created_at' => $sNow,
                    'updated_at' => $sNow,
                ];
            }
            File::insert($arPresentationsData);
            $arPresentationsIds = File::where('created_at', '=', $sNow)->get();
            $obBlock->files()->syncWithoutDetaching($arPresentationsIds);
        }
    }
}

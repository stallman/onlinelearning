<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SummerNoteController extends Controller
{
    public function upload(Request $request){
        $image = $request->file('file')->store('uploads/editor');
        return Storage::url($image);
    }

    public function delete(Request $request){
        $sPath = $request->src;
        $sPath = explode('storage/', $sPath);
        $sPath = $sPath[1];
        Storage::delete($sPath);
        return "Deleted succesfully - {$sPath}";
    }
}

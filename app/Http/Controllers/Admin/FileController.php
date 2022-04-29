<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Course;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function detachFromBlock(Request $request, File $obFile, Block $obBlock){
        $obBlock->files()->detach($obFile);
        Storage::delete($obFile->path);
        $obFile->delete();

        return back();
    }

    public function detachFromCourse(Request $request, File $obFile, Course $obCourse){
        $obCourse->files()->detach($obFile);
        Storage::delete($obFile->path);
        $obFile->delete();

        return back();
    }
}

<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlockController extends Controller
{
    public function markBlockIsRead(Request $request, Block $obBlock)
    {
        $obBlock->users()->sync(Auth::id(), ['is_read' => 1]);
        $obCourse = $obBlock->course;
        if($request->next_route){
            return redirect($request->next_route);
        }else{
            return redirect()->route('profile.courses.test.start', compact('obCourse'));
        }
    }
}

<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function changeVisible(Request $request){
        $arData = $request->validate([
            'is_visible' => 'required|boolean',
            'test_id' => 'required',
        ]);

        Test::findOrFail($arData['test_id'])->update($arData);
        return response()->json($arData);
    }
}

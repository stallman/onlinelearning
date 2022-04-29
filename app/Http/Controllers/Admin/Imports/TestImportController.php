<?php

namespace App\Http\Controllers\Admin\Imports;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Import\TestImportRequest;
use App\Models\Test;
use App\Services\Interfaces\Admin\Imports\TestImportServiceInterface;
use Illuminate\Http\Request;

class TestImportController extends Controller
{
    public function index(){
        $sPageTitle = 'Импорт тестов';
        $arTests = Test::all();
        return view('admin.tests.import.index', compact('sPageTitle', 'arTests'));
    }

    public function store(TestImportRequest $request, TestImportServiceInterface $obTestImportService){
        $arData = $request->validated();
        $obTestImportService->import($request->file('file'), $arData['test_id']);

        session()->flash('success', "Тест успешно импортирован");

        return back();
    }
}

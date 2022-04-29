<?php

namespace App\Http\Controllers\Admin\Imports;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Import\UserImportRequest;
use App\Models\User;
use App\Services\Admin\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class UserImportController extends Controller
{
    public function index(){
        $sPageTitle = 'Импорт пользователей';
        $arUsers = User::all();
        return view('admin.users.import.index', compact('sPageTitle', 'arUsers'));
    }

    public function store(UserImportRequest $request){
        $arData = $request->validated();

        Excel::import(new UsersImport, request()->file('file'));

        dd('successfull');
    }
}

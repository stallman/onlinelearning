<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Certificate\StoreCertificateRequest;
use App\Http\Requests\Admin\Certificate\UpdateCertificateRequest;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToImage\Pdf;

class CertificateController extends Controller
{
    public function store(StoreCertificateRequest $request, User $obUser, Course $obCourse){
        $arData = $request->validated();

        if($obUser->getCertificate($obCourse->id)){
            Certificate::destroy($obUser->getCertificate($obCourse->id)->id);
        }
        $arData['course_id'] =  $obCourse->id;
        $arData['user_id'] =  $obUser->id;

        $arData['path'] = $request->file('file')->store('certificates');
        $arData['name'] = $request->file('file')->getClientOriginalName();

        Certificate::create($arData);

        return back();
    }

    public function update(UpdateCertificateRequest $request, Certificate $obCertificate){
        $arData = $request->validated();

        if($request->file('file')){
            $arData['path'] = $request->file('file')->store('certificates');
            $arData['name'] = $request->file('file')->getClientOriginalName();
            Storage::delete($obCertificate->file);
        }else{
            unset($arData['file']);
        }

        $obCertificate->update($arData);

        return back();
    }

    public function delete(int $iId){
        Certificate::destroy($iId);

        return back();
    }
}

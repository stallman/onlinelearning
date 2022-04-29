<?php


namespace App\Services\Admin;


use App\Http\Requests\Admin\Course\StoreCourseRequest;
use App\Models\Course;
use App\Models\File;
use App\Models\User;
use Carbon\Carbon;
use http\Env\Request;

class CourseService
{
    public function storeOtherData(StoreCourseRequest $request, array $arData, Course $obCourse){
        if(isset($arData['teachers'])){
            $obCourse->teachers()->detach();
            $obCourse->teachers()->attach($arData['teachers']);
        }
        if(isset($arData['users'])){
            $obCourse->users()->attach($arData['users']);
            foreach ($arData['users'] as $iUserId){
                User::find($iUserId)->blocks()->attach($obCourse->blocks);
            }
        }
        if(isset($arData['specialities'])){
            $obCourse->specialities()->detach();
            $obCourse->specialities()->attach($arData['specialities']);
        }

        if(isset($arData['studyforms'])){
            $obCourse->studyforms()->detach();
            $obCourse->studyforms()->attach($arData['studyforms']);
        }

        if(is_array($request->file('files'))){
            $arMaterialsData = [];
            $sNow = Carbon::now()->toDateTimeString();
            foreach ($request->file('files') as $sKey => $mFile){
                $arMaterialsData[] = [
                    'type' => 'file',
                    'path' => $mFile->store('courses/files'),
                    'name' => $mFile->getClientOriginalName(),
                    'created_at' => $sNow,
                    'updated_at' => $sNow,
                ];
            }
            File::insert($arMaterialsData);
            $arMaterialsIds = File::where('created_at', '=', $sNow)->get();
            $obCourse->files()->attach($arMaterialsIds);
        }
    }
}

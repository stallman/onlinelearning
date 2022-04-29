<?php

use App\Http\Controllers\Api\Admin\SummerNoteController;
use App\Http\Controllers\Front\CourseController;
use App\Http\Controllers\Front\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*Api for summernote images */
/*
 * TODO: добавить защиту api
 *
 */
Route::name('admin.')->prefix('admin')->group(function(){
    Route::post('summernote/upload', [SummerNoteController::class, 'upload'])->name('summernote.upload.image');
    Route::post('summernote/delete', [SummerNoteController::class, 'delete'])->name('summernote.delete.image');

    Route::post('courses/change-visible', [\App\Http\Controllers\Api\Admin\CourseController::class, 'changeVisible']);
    Route::post('tests/change-visible', [\App\Http\Controllers\Api\Admin\TestController::class, 'changeVisible']);
});

Route::post('/request-to-course', \App\Http\Controllers\Api\RequestToCourseController::class)->name('request.to.course');

Route::get('/courses', \App\Http\Controllers\Api\CourseController::class);

Route::get('/get-specialty', [ProfileController::class, 'getSpecialty'])->name('specialty_get_data');
//
//
//Route::name('profile.')->prefix('profile')->middleware(['role:user', 'auth'])->group(function () {
//    Route::name('courses.')->prefix('courses')->group(function(){
//        Route::name('active.')->prefix('active')->group(function(){
//            Route::get('/sort-active-curses', [CourseController::class, 'sortActiveCurses'])->name('sort_active_curses');
//        });
//    });
//});

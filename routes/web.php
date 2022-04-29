<?php

use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\ReportCourseController as AdminReportCourseController;
use App\Http\Controllers\Admin\ReportCourseViewsController as AdminReportCourseViewsController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Front\FeedbackController as FrontFeedbackController;
use App\Http\Controllers\Front\BlockController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SpecializationController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\SpecialtyController;
use App\Http\Controllers\Front\CourseController;
use App\Http\Controllers\Front\ReportCourseController;
use App\Http\Controllers\Front\HomeController as FrontHomeController;
use App\Http\Controllers\Front\NewsController as FrontNewsController;
use App\Http\Controllers\Front\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontHomeController::class, 'index'])->name('home');
Route::get('/news', [FrontNewsController::class, 'index'])->name('news');
Route::get('/news/loadmore', [FrontNewsController::class, 'loadMore'])->name('news.loadmore');
Route::get('/news/{id}', [FrontNewsController::class, 'show'])->name('front.news.show');

Route::get('/contacts/', [FrontFeedbackController::class, 'index'])->name('feedback');
Route::post('/contacts/created', [FrontFeedbackController::class, 'store'])->name('front.feedback.store');

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/loadmore', [CourseController::class, 'loadmore'])->name('courses.loadmore');
Route::get('/courses/{obCourse}', [CourseController::class, 'detail'])->name('courses.detail');

Route::get('/search', [\App\Http\Controllers\Front\SearchController::class, 'index'])->name('search.index');
Route::get('/search/{iPage}', [\App\Http\Controllers\Front\SearchController::class, 'handle'])->name('search.handle');



Route::name('profile.')->prefix('profile')->middleware(['role:user', 'auth'])->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('home');

    Route::get('/documents', [\App\Http\Controllers\Front\CertificateController::class, 'index'])->name('certificates.index');

    Route::name('courses.')->prefix('courses')->group(function(){
        Route::get('/webinars', [CourseController::class, 'webinars'])->name('webinars');
        Route::get('/active', [CourseController::class, 'activeCourses'])->name('active');
        Route::name('active.')->prefix('active')->group(function(){
            Route::get('/sort-active-curses', [CourseController::class, 'sortActiveCurses'])->name('sort_active_curses');
        });
        Route::get('/completed', [CourseController::class, 'completedCourses'])->name('completed');
        Route::name('completed.')->prefix('completed')->group(function(){
            Route::get('/sort-completed-curses', [CourseController::class, 'sortСompletedCurses'])->name('sort_completed_curses');
        });
        Route::get('/available', [CourseController::class, 'availableCourses'])->name('available');
        Route::get('/{id}/literature', [CourseController::class, 'showLiterature'])->name('literature');
        Route::get('/{id}/teachers', [CourseController::class, 'showTeachers'])->name('teachers');
        Route::get('/{obCourse}/program', [CourseController::class, 'showProgram'])->name('program');
        Route::post('/{obCourse}/attach', [CourseController::class, 'attachUser'])->name('attach');
        Route::get('/{obCourse}', [CourseController::class, 'show'])->name('show');

        Route::get('/{obCourse}/test/complete', [App\Http\Controllers\Front\TestController::class, 'complete'])->name('test.complete');
        Route::get('/{obCourse}/test/reset', [App\Http\Controllers\Front\TestController::class, 'resetTest'])->name('test.reset');
        Route::get('/{obCourse}/test/start', [App\Http\Controllers\Front\TestController::class, 'start'])->name('test.start');
        Route::post('/{obCourse}/test/anketa', [App\Http\Controllers\Front\TestController::class, 'anketa'])->name('test.anketa');
        Route::any('/{obCourse}/test/{questionNum}',
            [App\Http\Controllers\Front\TestController::class, 'show'])->name('test')->middleware('answer.check');

        Route::get('/{id}/{blockId}', [CourseController::class, 'showBlock'])->name('show.block');
        Route::get('/{obCourse}/{obBlock}/materials', [CourseController::class, 'showBlockMaterials'])->name('show.block.materials');
    });

    Route::post('/blocks/{obBlock}/mark-is-read', [BlockController::class, 'markBlockIsRead'])->name('block.mark.is.read');
});
Route::post('/users/update', [\App\Http\Controllers\Front\UserController::class, 'update'])->name('users.update');
Route::post('/users/upload/image', [\App\Http\Controllers\Front\UserController::class, 'uploadImage'])->name('users.upload.image');

Route::name('admin.')->prefix('admin')->middleware(['role:admin', 'auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::resource('/specializations', SpecializationController::class);
    Route::resource('/speciality', SpecialtyController::class);
    Route::resource('/banners', BannerController::class);
    Route::resource('/feedback', FeedbackController::class);
    Route::resource('/news', NewsController::class);
    Route::resource('/course-categories', \App\Http\Controllers\Admin\CourseCategoryController::class);

    Route::resource('/courses', AdminCourseController::class);
    Route::post('/courses/{obCourse}/{obUser}/detach', [AdminCourseController::class, 'detachUser'])->name('courses.user.detach');
    Route::post('/courses/{obCourse}/detach-users', [AdminCourseController::class, 'detachUsers'])->name('courses.users.detach');

    Route::get('/report-courses', [AdminReportCourseController::class, 'showResults'])->name('report-courses.show-results');
    Route::get('/report-courses-views', [AdminReportCourseController::class, 'showViews'])->name('report-courses.show-views');
    Route::get('/report-courses-anketa', [AdminReportCourseController::class, 'showAnketa'])->name('report-courses.show-anketa');

    Route::get('/report-courses/{obCourse}/export', [AdminReportCourseController::class,'exportResults'])->name('report-courses.export');
    Route::get('/report-courses-views/{obCourse}/export', [AdminReportCourseController::class,'exportViews'])->name('report-courses-views.export');
    Route::get('/report-courses-anketa/{obCourse}/export', [AdminReportCourseController::class,'exportAnketa'])->name('report-courses-anketa.export');


    Route::resource('/blocks', \App\Http\Controllers\Admin\BlockController::class);

    Route::post('/tests/import', [\App\Http\Controllers\Admin\Imports\TestImportController::class, 'store'])->name('tests.import.store');
    Route::get('/tests/import', [\App\Http\Controllers\Admin\Imports\TestImportController::class, 'index'])->name('tests.import.index');
    Route::post('/users/import', [\App\Http\Controllers\Admin\Imports\UserImportController::class, 'store'])->name('users.import.store');
    Route::get('/users/import', [\App\Http\Controllers\Admin\Imports\UserImportController::class, 'index'])->name('users.import.index');
    Route::resource('/tests/verification', App\Http\Controllers\Admin\Tests\TestVerificationController::class, [
        'as' => 'tests'
    ]);
    Route::resource('/tests', App\Http\Controllers\Admin\Tests\TestController::class);

    Route::resource('/questions', \App\Http\Controllers\Admin\QuestionController::class);
    Route::resource('/answers', \App\Http\Controllers\Admin\AnswerController::class);

    Route::resource('/users', \App\Http\Controllers\Admin\Users\UserController::class);
    Route::post('/users/{obUser}/{obCourse}/detach', [\App\Http\Controllers\Admin\Users\UserController::class, 'detachCourse'])
        ->name('users.course.detach');

    Route::resource('/curators', \App\Http\Controllers\Admin\Users\CuratorController::class);
    Route::resource('/teachers', \App\Http\Controllers\Admin\Users\TeacherController::class);

    Route::resource('/requests-to-courses', \App\Http\Controllers\Admin\RequestToCourseController::class);

    Route::post('/files/{obFile}/detach/{obBlock}', [\App\Http\Controllers\Admin\FileController::class, 'detachFromBlock'])->name('file.block.detach');
    Route::post('/files/{obFile}/detach/course/{obCourse}', [\App\Http\Controllers\Admin\FileController::class, 'detachFromCourse'])->name('file.course.detach');

    Route::post('/certificate/{obUser}/{obCourse}/store', [\App\Http\Controllers\Admin\CertificateController::class, 'store'])->name('certificates.store');
    Route::delete('/certificate/{iId}', [\App\Http\Controllers\Admin\CertificateController::class, 'delete'])->name('certificates.delete');
    Route::patch('/certificate/{obCertificate}', [\App\Http\Controllers\Admin\CertificateController::class, 'update'])->name('certificates.update');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

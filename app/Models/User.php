<?php

namespace App\Models;

use App\Services\Interfaces\MailServiceInterface;
use App\Services\MailService;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'surname',
        'name',
        'patronymic',
        'email',
        'phone',
        'job' ,
        'specialization_id',
        'other_specialization',
        'position',
        'password',
        'image',
//        'education_level',
        'education_level_id',
        'speciality_id',
        'other_speciality',
        'certificate',
        'description',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullNameAttribute(){
        return "{$this->surname} {$this->name} {$this->patronymic}";
    }

    public function getCuratorDisplayNameAttribute(){
        return "{$this->surname} <br> {$this->name} {$this->patronymic}";
    }

    public function getActiveCoursesAttribute(){
        return $this->belongsToMany(Course::class)->wherePivot('is_completed', '0');
    }

    public function getCompletedCoursesAttribute(){
        return $this->belongsToMany(Course::class)->wherePivot('is_completed', '1');
    }

    public function questions(){
        return $this->belongsToMany(Question::class)->withTimestamps();
    }

    public function answers(){
        return $this->belongsToMany(Answer::class)->withTimestamps();
    }

    public function tests(){
        return $this->belongsToMany(Test::class)->withTimestamps()->withPivot(['is_started', 'is_completed']);
    }

    public function blocks(){
        return $this->belongsToMany(Block::class)->withTimestamps()->withPivot(['is_read']);
    }

    public function courses(){
        return $this->belongsToMany(Course::class)->withTimestamps();
    }
    public function getCertificate(int $iCourseId)
    {
        return $this->hasMany(Certificate::class)->where('course_id', '=', $iCourseId)->first();
    }

    public function getReadBlocks(int $iCourseId){
        return $this->blocks()
            ->where('is_read', '=', 1)
            ->where('course_id', '=', $iCourseId)
            ->get();
    }

    public function getBlocksByCourse(int $iCourseId){
        return $this->blocks()
            ->where('course_id', '=', $iCourseId)
            ->orderBy('order')
            ->get();
    }

    public function getCurrentTest(int $iTestId): ?Test
    {
        return $this->tests()->where('test_id', '=', $iTestId)->first();
    }

    public function getCourseTestEndedDate(Course $obCourse){
        $sAllocatedTime = $obCourse->test->allocated_time;
        $iHours = Carbon::parse($sAllocatedTime)->hour;
        $iMinutes = Carbon::parse($sAllocatedTime)->minute;
        $iSeconds = Carbon::parse($sAllocatedTime)->second;
        $obEndedAt = Auth::user()->getCurrentTest($obCourse->test->id)->pivot->created_at;
        $obEndedAt->addHours($iHours);
        $obEndedAt->addMinutes($iMinutes);
        $obEndedAt->addSeconds($iSeconds);
        return $obEndedAt;
    }

    public function sendPasswordResetNotification($token)
    {
        $obMailServiceInterface = new MailService();

        $sUrl = route('password.reset', $token);

        $sMailBody = "
            Если вы хотите сбросить пароль, по перейдиет по <a href=\"{$sUrl}\">ссылке</a> <br>
            Если сбрасываете пароль не вы, то не делайте ничего.
        ";

        $obMailServiceInterface->send($this->email, '"Дистанционное обучение" сброс пароля', $sMailBody);
    }

}

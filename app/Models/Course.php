<?php

namespace App\Models;

use App\Models\Interfaces\DisplayedWhenSearching;
use App\Models\Traits\FindTags;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Course extends Model implements DisplayedWhenSearching
{
    use HasFactory, FindTags;

    protected $fillable = [
        'title',
        'course_category_id',
        'is_home_visible',
        'is_visible',
        'date_start',
        'date_end',
        'description',
        'literature',
        'user_id',
        'test_id',
        'image',
        'is_nmo_balls',
        'duration',
        'education_level_id',
        'price',
        'is_has_certificate',
        'content',
        'program',
        'is_anketable'
    ];

    public function curator(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function blocks(){
        return $this->hasMany(Block::class)->where('parent_id', '=', null)->orderBy('order');
    }

    public function test(){
        return $this->belongsTo(Test::class);
    }

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function teachers(){
        return $this->belongsToMany(User::class, 'course_teacher')->withTimestamps();
    }

    public function files(){
        return $this->belongsToMany(File::class)->withTimestamps();
    }

    public function specialities()
    {
        return $this->belongsToMany(Speciality::class);
    }

    public function studyforms()
    {
        return $this->belongsToMany(StudyForm::class);
    }

    public function getReadPercent(User $obUser) : int
    {
        $iCountBlocks = count($this->blocks);
        $iReadBlocks = count($obUser->getReadBlocks($this->id));
        if($iCountBlocks !== 0){
            $iPercentRead = number_format(((100 / $iCountBlocks) * $iReadBlocks));
            $iResult = $this->test_results;
            if($iResult <= $this->test->minimal_right_questions && (int)$iPercentRead !== 0){
                $iPercentRead -= (100 / $iCountBlocks);
            }
        }else{
            $iPercentRead = 0;
        }


        return $iPercentRead;
    }

    public function getStartDateAttribute(){
        return date('d.m.Y', strtotime($this->date_start));
    }

    public function getCurrentUserEndedDateAttribute(){
        return date('d.m.Y', strtotime($this->users()->where('course_user.user_id', '=', Auth::id())->first()->pivot->updated_at));
    }

    public function setUserLastView() {
        $this->users()->updateExistingPivot(Auth::id(), ['last_view' => now()]);
    }

    public function setUserLastSendNotification($userId) {
        $this->users()->updateExistingPivot($userId, ['last_send_notification' => now()]);
    }

    public function getTestResultsAttribute(){
        $iResult = 0;

        foreach($this->test->questions as $obQ){
            if (isset($obQ->answered) && $obQ->answered->is_right === 1) {
                $iResult++;
            }
        }
        return $iResult;
    }

    public function getDurationInMonthsAttribute(){
        $obDateStart = Carbon::parse($this->date_start);
        $obDateEnd = Carbon::parse($this->date_end);

        return $obDateStart->diffInMonths($obDateEnd);
    }

    public function getSearchDescription(string $sFindStr): string
    {
        if(mb_stripos($this->description, $sFindStr)){
            $arWords = explode(' ', strip_tags($this->getContentForSearch()));
        }else{
            $arWords = explode(' ', strip_tags($this->content));
        }

        $i = 0;
        foreach ($arWords as $sWord){
            if(mb_stripos($sWord, $sFindStr) !== false){
                break;
            }
            $i++;
        }
        $i = $i >= 5 ? $i - 3 : $i;
        $sContent = implode(' ', array_slice($arWords, $i));
        $sString = implode(' ', array_slice(explode(' ', $sContent), 0,
                DisplayedWhenSearching::COUNT_OF_WORDS)) . '...';
        $sWithoutSpan = $this->removeTag('span', $sString);
        if($i === 0){
            return $this->wrapToTag('span', $sWithoutSpan, $sFindStr);
        }else{
            return '...' . $this->wrapToTag('span', $sWithoutSpan, $sFindStr);
        }

    }

    public function getTypeAttribute(): array
    {
        return [
            'title' => 'Курсы ДПО',
            'route' => route('courses.index'),
        ];
    }

    public function getRoute(): string
    {
        return route('courses.detail', ['obCourse' => $this]);
    }

    public function getContentForSearch(): string
    {
        return $this->description;
    }

    public function getTitleForSearch(string $sFindStr): string
    {
        return $this->wrapToTag('span', $this->title, $sFindStr);
    }
}

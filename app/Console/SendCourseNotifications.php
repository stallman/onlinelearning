<?php

namespace App\Console;

use Carbon\Carbon;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; 
use PHPMailer\PHPMailer\PHPMailer;
use App\Services\Interfaces\MailServiceInterface;

class SendCourseNotifications
{
    public function __invoke(MailServiceInterface $obMailService) {
        
        //Log::debug('Shedule: SendCourseNotifications ...');
        $courses = Course::where('date_start', '<', Carbon::now())->where('date_end', '>', Carbon::now())->get();
        foreach ($courses as $course) {
              
            //Log::debug('course ... '.$course->id);

            foreach ($course->users()->wherePivot('is_completed','0')->wherePivot('last_view', '<=', Carbon::now()->subDays(3))->wherePivot('last_send_notification', '<=', Carbon::now()->subDays(3))->get() as $user) {
            
                $sMailBody = "
                <p>Уважаемый слушатель!</p>
                <p>Напоминаем Вам, что Вы проходите обучение по программе повышения квалификации \"$course->title\" на сайте <a href='".env('APP_URL')."'>Дистанционное обучение</a>. Просим Вас зайти с свой личный кабинет, чтобы ознакомиться с расписанием занятий и просмотреть учебные материалы курса. Это необходимо сделать для того, чтобы получить удостоверение о повышении квалификации и баллы НМО.</p>";

                $obMailService->send($user->email, 'Напоминание с сайта "Дистанционное обучение"', $sMailBody);

                $course->setUserLastSendNotification($user->id);
            }
        }
    }    
}

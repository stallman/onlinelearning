<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreRequestToCourseRequest;
use App\Models\RequestToCourse;
use App\Services\Interfaces\MailServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PHPMailer\PHPMailer\PHPMailer;

class RequestToCourseController extends Controller
{
    /**
     * Подготовить новый веб-сервер.
     *
     * @param StoreRequestToCourseRequest $request
     * @param MailServiceInterface $obMailService
     * @return \Illuminate\Http\Response
     */
    public function __invoke(StoreRequestToCourseRequest $request, MailServiceInterface $obMailService)
    {
        $arData = $request->validated();
        $arData['request_file'] = $request->file('request_file')->store('requests_to_courses');
        RequestToCourse::create($arData);

        $sUrlToFile = url(Storage::url($arData['request_file']));
        $sMailBody = "
            ФИО: {$arData['surname']} {$arData['name']} {$arData['patronymic']} <br>
            email: {$arData['email']} <br>
            Заявка: <a href=\"{$sUrlToFile}\">Ссылка</a>
        ";

        $obMailService->send('niiozmm‑dpo@zdrav.mos.ru', 'Заявка на обучение с сайта "Дистанционное обучение"', $sMailBody);

        return response()->json($request->validated());
    }
}

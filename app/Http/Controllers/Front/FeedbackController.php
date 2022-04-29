<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Feedback\StoreFeedbackRequest;
use App\Models\Feedback;
use App\Services\Interfaces\MailServiceInterface;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use Captcha;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($arUserData = null)
    {
        $captcha = Captcha::chars('123456789ABCDEFGHIJKLMNPQRSTUVWXYZ')->generate();
        return view('front.feedback.index', compact('captcha', 'arUserData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFeedbackRequest $request
     * @param MailServiceInterface $obMailService
     * @return \Illuminate\Http\Response
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function store(StoreFeedbackRequest $request, MailServiceInterface $obMailService)
    {
        try
        {
            $data = $request->validated();

            $sMailBody = "ФИО пользователя: {$data['fullname']}<br>
                          Почта пользователя: {$data['email']}<br>
                          Вопрос: {$data['question']}<br>";

            $arUserData = [
                'fullname' => $data['fullname'],
                'question' => $data['question'],
                'email' => $data['email'],
            ];

            $captchaId = $request->captcha_id;
            $captchaText = $request->captcha;

            $captcha = Captcha::chars('123456789ABCDEFGHIJKLMNPQRSTUVWXYZ')->generate();

            if (!empty($captchaText)) {
                if (!Captcha::validate($captchaId, $captchaText)) {
                    session()->flash('success', "Неверно введена капча, попробуйте ещё раз.");
                    return view('front.feedback.index', compact('captcha', 'arUserData'));
                }
            } else {
                session()->flash('success', "Неверно введена капча, попробуйте ещё раз.");
                return view('front.feedback.index', compact('captcha', 'arUserData'));
            }

            Feedback::create($data);

            $obMailService->send('niiozmm‑dpo@zdrav.mos.ru', 'Пришёл вопрос с сайта "Дистанционное обучение"', $sMailBody);

            session()->flash('success', "Ваш вопрос успешно отправлен");
            return redirect()->route('feedback');
        }
        catch (Exception $e)
        {
            session()->flash('success', "Не удалось отправить ваш вопрос. Попробуйте позже.");
            return redirect()->route('feedback');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

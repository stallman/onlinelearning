<?php

namespace App\Services;

use App\Services\Interfaces\MailServiceInterface;
use PHPMailer\PHPMailer\PHPMailer;

class MailService implements MailServiceInterface
{
    public function send(string $sTo, string $sSubject, string $sMailBody){
        $obMail = new PHPMailer();
        // Настройки SMTP
        $obMail->isSMTP();
        $obMail->SMTPAuth = true;
        $obMail->SMTPDebug = 0;

        $obMail->Host = '';
        $obMail->Port = 25;
        $obMail->Username = '';
        $obMail->Password = '';
        $obMail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $obMail->From = '';
        $obMail->FromName = 'Почтовый сервис';
        $obMail->addAddress($sTo);

        $obMail->Subject = $sSubject;
        $obMail->CharSet = 'utf-8';
        $obMail->Body = $sMailBody;
        $obMail->IsHTML(true);
        $obMail->send();
    }
}

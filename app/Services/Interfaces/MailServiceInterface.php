<?php

namespace App\Services\Interfaces;

interface MailServiceInterface
{
    public function send(string $sTo, string $sSubject, string $sMailBody);
}

<?php

namespace App\Services;

use App\Mail\DefaultMail;
use Illuminate\Support\Facades\Mail;

class MailSenderService
{
  public static function sendMail(string $name, string $subject, string $content, string $toMail)
  {
    Mail::send(new DefaultMail(
      name: $name,
      mailSubject: $subject,
      content: $content,
      toMail: $toMail
    ));
  }
}





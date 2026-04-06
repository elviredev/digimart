<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ContactRequest;
use App\Models\ContactInfoSection;
use App\Services\MailSenderService;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
  public function index(): View
  {
    $contactInfo = ContactInfoSection::first();
    return view('frontend.pages.contact', compact('contactInfo'));
  }

  public function sendMail(ContactRequest $request): RedirectResponse
  {
    MailSenderService::sendContactMail(
      name: $request->name,
      subject: $request->subject,
      content: $request->message,
      fromMail: $request->email,
      toMail: config('settings.site_email')
    );

    NotificationService::CREATED('Message sent successfully.');

    return back();
  }
}



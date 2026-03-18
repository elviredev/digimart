<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use App\Services\MailSenderService;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WithdrawRequestController extends Controller
{
  public function index():View
  {
    $withdrawRequests = Withdraw::paginate(25);
    return view('admin.withdraw-request.index', compact('withdrawRequests'));
  }

  public function show(string $id): View
  {
    $withdrawRequest = Withdraw::findOrFail($id);
    return view('admin.withdraw-request.show', compact('withdrawRequest'));
  }

  public function updateStatus(Request $request, string $id): RedirectResponse
  {
    $request->validate([
      'status' => ['required', 'in:pending,paid,rejected'],
    ]);

    $withdrawRequest = Withdraw::findOrFail($id);
    $withdrawRequest->status = $request->status;
    $withdrawRequest->save();

    $amount = currencyPosition($withdrawRequest->amount_formatted);

    if($withdrawRequest->status == 'paid') {
      // update balance
      $updateBalance = $withdrawRequest->author;
      $updateBalance->balance = $updateBalance->balance - $withdrawRequest->amount;
      $updateBalance->save();

      // send email to author
      MailSenderService::sendMail(
        name: $withdrawRequest->author->name,
        subject: __('Withdrawal Request Approved'),
        content: __("Your withdrawal request for amount $amount \n has been paid successfully."),
        toMail: $withdrawRequest->author->email
      );
    } elseif ($withdrawRequest->status == 'rejected') {
      MailSenderService::sendMail(
        name: $withdrawRequest->author->name,
        subject: __('Withdrawal Request Rejected'),
        content: __("Your withdrawal request for amount $amount has been rejected. Please try again or contact support."),
        toMail: $withdrawRequest->author->email
      );
    }

    NotificationService::UPDATED();

    return to_route('admin.withdraw-requests.index');
  }
}

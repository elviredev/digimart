<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthorWithdrawController extends Controller
{
  public function index(): View
  {
    return view('frontend.dashboard.withdraw.index');
  }

  public function create(): View
  {
    return view('frontend.dashboard.withdraw.create');
  }

  public function store(Request $request): RedirectResponse
  {
    $request->validate([
      'amount' => ['required', 'numeric']
    ]);

    $withdrawGateway = user()->authorWithdrawInfo?->withdrawGateway;
    if($request->amount < $withdrawGateway->minimum_amount) {
      throw ValidationException::withMessages([
        'amount' => __('The minimum amount for withdraw is :amount',
          ['amount' => $withdrawGateway->minimum_amount_formatted]
        )
      ]);
    } elseif ($request->amount > $withdrawGateway->maximum_amount) {
      throw ValidationException::withMessages([
        'amount' => __('The maximum amount for withdraw is :amount',
          ['amount' => $withdrawGateway->maximum_amount_formatted]
        )
      ]);
    } elseif ($request->amount > user()->balance) {
      throw ValidationException::withMessages(['amount' => __('You don\'t have enough balance')]);
    } elseif (user()->withdraws()->whereStatus('pending')->exists()) {
      throw ValidationException::withMessages(['amount' => __('You already have a pending withdraw request')]);
    }

    $withdrawRequest = new Withdraw();
    $withdrawRequest->author_id = user()->id;
    $withdrawRequest->amount = $request->amount;
    $withdrawRequest->method = $withdrawGateway->name;
    $withdrawRequest->account = user()->authorWithdrawInfo?->information;
    $withdrawRequest->status = 'pending';
    $withdrawRequest->save();

    NotificationService::CREATED(__('Withdraw request has been sent successfully'));

    return to_route('user.withdraws.index');
  }
}

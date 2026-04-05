<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Services\MailSenderService;
use App\Services\NotificationService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SubscribersController extends Controller
{
  /**
   * Display a paginated list of subscribers.
   * @return \Illuminate\View\View
   */
  public function index(): View
  {
    $subscribers = Subscription::latest()->paginate(25);
    return view('admin.subscriber.index', compact('subscribers'));
  }

  /**
   * Send a newsletter to all subscribers.
   * @param Request $request
   * @return RedirectResponse
   */
  public function sendNewsletter(Request $request): RedirectResponse
  {
    $request->validate([
      'subject' => ['required'],
      'message' => ['required'],
    ]);

    $emails = Subscription::pluck('email')->toArray();

    MailSenderService::sendBulkNewsletterMail($request->subject, $request->message, $emails);

    NotificationService::CREATED('Newsletter sent successfully');

    return back();
  }

  /**
   * Delete the specified subscriber and sends a deletion notification.
   * @param Subscription $subscriber The subscriber to be deleted.
   * @return JsonResponse A JSON response indicating the success or failure of the operation.
   */
  public function destroy(Subscription $subscriber): JsonResponse
  {
    try {
      $subscriber->delete();

      NotificationService::DELETED();

      return response()->json([
        'status' => 'success',
        'message' => __('Subscriber email deleted successfully.')
      ], 200);
    } catch (Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => $e->getMessage()
      ]);
    }
  }

}

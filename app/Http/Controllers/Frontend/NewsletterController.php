<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(Request $request)
  {
    $request->validate([
      'email' => ['required', 'email:rfc,dns', 'unique:subscriptions,email']
    ]);

    $subscribe = new Subscription();
    $subscribe->email = $request->email;
    $subscribe->save();

    return response()->json([
      'status' => 'success',
      'message' => __('You have successfully subscribed to our newsletter.'),
    ]);
  }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ItemReview;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
  public function index(): View
  {
    return view('frontend.dashboard.index');
  }

  public function reviews(): View
  {
    $reviews = ItemReview::where('user_id', user()->id)->latest()->paginate(15);
    return view('frontend.dashboard.review.index', compact('reviews'));
  }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ItemReview;
use App\Models\PurchaseItem;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
  public function index(): View
  {
    $purchaseCount = PurchaseItem::where('user_id', user()->id)->count();
    $reviewCount = ItemReview::where('user_id', user()->id)->count();
    $totalSpent = PurchaseItem::where('user_id', user()->id)->sum('price');
    $totalTransaction = Transaction::where('user_id', user()->id)->count();

    return view('frontend.dashboard.index', compact('purchaseCount', 'reviewCount', 'totalSpent', 'totalTransaction'));
  }

  public function reviews(): View
  {
    $reviews = ItemReview::where('user_id', user()->id)->latest()->paginate(15);
    return view('frontend.dashboard.review.index', compact('reviews'));
  }
}

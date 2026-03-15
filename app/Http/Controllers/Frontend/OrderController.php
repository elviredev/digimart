<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PurchaseItem;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;

class OrderController extends Controller
{
  public function index(): View
  {
    $purchases = PurchaseItem::where('user_id', user()->id)->paginate(15);
    return view('frontend.dashboard.order.index', compact('purchases'));
  }

  public function show(string $id): View
  {
    $purchaseItem = PurchaseItem::findOrFail($id);
    return view('frontend.dashboard.order.show', compact('purchaseItem'));
  }

  public function transactions(): View
  {
    $transactions = Transaction::where('user_id', user()->id)->latest()->paginate(15);
    return view('frontend.dashboard.order.transaction', compact('transactions'));
  }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AuthorSale;
use App\Models\PurchaseItem;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
  public function index(): View
  {
    $purchases = PurchaseItem::with([
      'item.category:id,name',
      'item.subCategory:id,name'
    ])
      ->where('user_id', user()->id)
      ->paginate(15);
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

  public function sales(): View
  {
    abort_if(user()->user_type != 'author', 403, 'Unauthorized action.');

    $sales = AuthorSale::where('author_id', user()->id)->latest()->paginate(15);
    return view('frontend.dashboard.order.sales', compact('sales'));
  }

  public function downloadPurchasedItem(string $id)
  {
    $purchaseItem = user()->purchaseItems()
      ->where('item_id', $id)
      ->firstOrFail();

    if (Storage::disk('local')->exists($purchaseItem->item->main_file)) {
      return Storage::disk('local')->download($purchaseItem->item->main_file);
    }

    abort(404);
  }
}

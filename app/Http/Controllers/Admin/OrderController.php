<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Contracts\View\View;

class OrderController extends Controller
{
  public function index():View
  {
    $orders = Purchase::with(['user:id,name', 'transaction', 'purchaseItems'])->paginate(25);
    return view('admin.order.index', compact('orders'));
  }

  public function show(string $id): View
  {
    $order = Purchase::findOrFail($id);
    return view('admin.order.show', compact('order'));
  }
}

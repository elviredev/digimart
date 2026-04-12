<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class OrderController extends Controller implements HasMiddleware
{
  /** Middleware for Permission Manage Orders */
  public static function middleware(): array
  {
    return [
      new Middleware('permission:manage orders')
    ];
  }

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

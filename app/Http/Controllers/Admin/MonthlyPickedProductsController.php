<?php

namespace app\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\MonthlyPickedProduct;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class MonthlyPickedProductsController extends Controller implements HasMiddleware
{
  /** Middleware for Permission Manage Sections */
  public static function middleware(): array
  {
    return [
      new Middleware('permission:manage sections')
    ];
  }

  /**
   * Display a listing of the resource.
   */
  public function index(): View
  {
    $monthlyPickedSection = MonthlyPickedProduct::first();
    $selectedProducts = Item::select(['id', 'name'])->whereIn('id', $monthlyPickedSection?->item_ids ?? [])->get();
    return view('admin.sections.monthly-picked-product.index', compact('monthlyPickedSection', 'selectedProducts'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $request->validate([
      'title' => ['required', 'string', 'max:255'],
      'description' => ['required', 'string', 'max:255'],
      'monthly_picked_items' => ['required', 'array'],
    ]);

    MonthlyPickedProduct::updateOrCreate(
      ['id' => 1],
      [
        'title' => $request->title,
        'description' => $request->description,
        'item_ids' => $request->monthly_picked_items
      ]
    );

    NotificationService::UPDATED();

    return back();
  }

}

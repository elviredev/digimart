<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HighlightedProduct;
use App\Models\Item;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class HighlightedProductController extends Controller implements HasMiddleware
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
    $highlightedProduct = HighlightedProduct::first();
    $selectedProducts = Item::select(['id', 'name'])
      ->whereIn('id', $highlightedProduct->item_ids)
      ->get();

    return view('admin.sections.highlighted-product.index', compact('highlightedProduct', 'selectedProducts'));
  }


  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $request->validate([
      'title' => ['required', 'string', 'max:255'],
      'subtitle' => ['required', 'string', 'max:255'],
      'item_ids' => ['required', 'array']
    ]);

    HighlightedProduct::updateOrCreate(
      ['id' => 1],
      [
        'title' => $request->title,
        'subtitle' => $request->subtitle,
        'item_ids' => $request->item_ids
      ]
    );

    NotificationService::UPDATED();

    return back();
  }

}

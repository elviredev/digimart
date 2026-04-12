<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FlashSaleBannerUpdateRequest;
use App\Models\FlashSaleBanner;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class FlashSaleBannerController extends Controller implements HasMiddleware
{
  /** Middleware for Permission Manage Banner */
  public static function middleware(): array
  {
    return [
      new Middleware('permission:manage banner')
    ];
  }

  /**
   * Display a listing of the resource.
   */
  public function index(): View
  {
    $flashBanner = FlashSaleBanner::first();
    return view('admin.flash-banner.index', compact('flashBanner'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(FlashSaleBannerUpdateRequest $request, string $id)
  {
    $validatedData = $request->validated();
    FlashSaleBanner::updateOrCreate(
      ['id' => 1],
      $validatedData
    );

    NotificationService::UPDATED();

    return back();
  }
}

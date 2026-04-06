<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FlashSaleBannerUpdateRequest;
use App\Models\FlashSaleBanner;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;

class FlashSaleBannerController extends Controller
{
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

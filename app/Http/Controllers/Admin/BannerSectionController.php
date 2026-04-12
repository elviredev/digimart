<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BannerSection;
use App\Services\NotificationService;
use App\Traits\FileUploadTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class BannerSectionController extends Controller implements HasMiddleware
{
  use FileUploadTrait;

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
    $bannerSection = BannerSection::first();
    return view('admin.sections.banner-section.index', compact('bannerSection'));
  }


  /**
   * Update the specified resource in storage.
   */
  public function updateBannerOne(Request $request)
  {
    $validatedData = $request->validate([
      'background_image_one' => ['nullable', 'image', 'max:2048'],
      'banner_title_one' => ['nullable', 'string', 'max:255'],
      'banner_subtitle_one' => ['nullable', 'string', 'max:255'],
      'button_text_one' => ['nullable', 'string', 'max:255'],
      'button_url_one' => ['nullable', 'string', 'max:255'],
    ]);

    // Image Upload
    if ($request->hasFile('background_image_one')) {
      $validatedData['background_image_one'] = $this->uploadFile($request->file('background_image_one'));
    }

    BannerSection::updateOrCreate(
      ['id' => 1],
      $validatedData
    );

    NotificationService::UPDATED();

    return back();
  }

  /**
   * Update the specified resource in storage.
   */
  public function updateBannerTwo(Request $request)
  {
    $validatedData = $request->validate([
      'background_image_two' => ['nullable', 'image', 'max:2048'],
      'banner_title_two' => ['nullable', 'string', 'max:255'],
      'banner_subtitle_two' => ['nullable', 'string', 'max:255'],
      'button_text_two' => ['nullable', 'string', 'max:255'],
      'button_url_two' => ['nullable', 'string', 'max:255'],
    ]);

    // Image Upload
    if ($request->hasFile('background_image_two')) {
      $validatedData['background_image_two'] = $this->uploadFile($request->file('background_image_two'));
    }

    BannerSection::updateOrCreate(
      ['id' => 1],
      $validatedData
    );

    NotificationService::UPDATED();

    return back();
  }

}

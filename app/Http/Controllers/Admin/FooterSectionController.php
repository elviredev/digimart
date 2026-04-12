<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSection;
use App\Services\NotificationService;
use App\Traits\FileUploadTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class FooterSectionController extends Controller implements HasMiddleware
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
    $footerSection = FooterSection::first();
    return view('admin.sections.footer-section.index', compact('footerSection'));
  }



  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $validatedData = $request->validate([
      'description' => ['required', 'string', 'max:255'],
      'items_sold' => ['nullable', 'string', 'max:255'],
      'community_earnings' => ['nullable', 'string', 'max:255'],
      'copyright' => ['required', 'string', 'max:255'],
      'gateway_image' => ['nullable', 'image', 'max:2048'],
    ]);

    if ($request->hasFile('gateway_image')) {
      $validatedData['gateway_image'] = $this->uploadFile($request->file('gateway_image'));
    }

    FooterSection::updateOrCreate(
      ['id' => 1],
      $validatedData
    );

    NotificationService::UPDATED();
    return back();
  }
}

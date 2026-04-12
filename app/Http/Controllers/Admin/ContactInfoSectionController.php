<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContactInfoUpdateRequest;
use App\Models\ContactInfoSection;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ContactInfoSectionController extends Controller implements HasMiddleware
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
    $contactInfo = ContactInfoSection::first();
    return view('admin.sections.contact-section.index', compact('contactInfo'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(ContactInfoUpdateRequest $request, string $id)
  {
    $validatedData = $request->validated();

    ContactInfoSection::updateOrCreate(
      ['id' => 1],
      $validatedData
    );

    NotificationService::UPDATED();

    return back();
  }
}

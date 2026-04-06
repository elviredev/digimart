<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContactInfoUpdateRequest;
use App\Models\ContactInfoSection;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ContactInfoSectionController extends Controller
{
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

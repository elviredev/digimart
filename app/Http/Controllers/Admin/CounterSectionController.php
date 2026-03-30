<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CounterSection;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CounterSectionController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(): View
  {
    $counterSection = CounterSection::first();
    return view('admin.sections.counter-section.index', compact('counterSection'));
  }


  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $validatedData = $request->validate([
      'title' => ['required', 'string', 'max:255'],
      'subtitle' => ['required', 'string', 'max:255'],
      'label_one' => ['required', 'string', 'max:255'],
      'counter_one' => ['required', 'numeric'],
      'label_two' => ['required', 'string', 'max:255'],
      'counter_two' => ['required', 'numeric'],
      'label_three' => ['required', 'string', 'max:255'],
      'counter_three' => ['required', 'numeric'],
      'label_four' => ['required', 'string', 'max:255'],
      'counter_four' => ['required', 'numeric'],
    ]);

    CounterSection::updateOrCreate(
      ['id' => 1],
      $validatedData
    );

    NotificationService::UPDATED();

    return back();
  }

}

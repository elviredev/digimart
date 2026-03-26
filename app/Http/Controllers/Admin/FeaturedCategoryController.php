<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FeaturedCategory;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FeaturedCategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(): View
  {
    $categories = Category::all();
    $featuredCategories = FeaturedCategory::first();
    return view('admin.sections.featured-category.index', compact('categories', 'featuredCategories'));
  }


  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $request->validate([
      'categories' => ['required', 'array']
    ]);

    FeaturedCategory::updateOrCreate(
      ['id' => $id],
      ['category_ids' => $request->categories]
    );

    NotificationService::UPDATED();

    return back();
  }

}

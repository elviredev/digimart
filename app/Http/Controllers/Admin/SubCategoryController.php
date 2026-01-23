<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubCategoryStoreRequest;
use App\Http\Requests\Admin\SubCategoryUpdateRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Services\NotificationService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;

class SubCategoryController extends Controller implements HasMiddleware
{
  /** Middleware for Permission Module Category */
  public static function middleware(): array
  {
    return [
      new Middleware('permission:manage categories')
    ];
  }

  /**
   * Display a listing of the resource.
   */
  public function index(): View
  {
    $subCategories = SubCategory::paginate(5);
    return view('admin.category.sub-category.index', compact('subCategories'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(): View
  {
    $categories = Category::all();
    return view('admin.category.sub-category.create', compact('categories'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(SubCategoryStoreRequest $request): RedirectResponse
  {
    $subCategory = new SubCategory();
    $subCategory->name = $request->name;
    $subCategory->slug = Str::slug($request->name);
    $subCategory->category_id = $request->category;
    $subCategory->save();

    NotificationService::CREATED();

    return to_route('admin.sub-categories.index');
  }


  /**
   * Show the form for editing the specified resource.
   */
  public function edit(SubCategory $subCategory): View
  {
    $categories = Category::all();
    return view('admin.category.sub-category.edit', compact('subCategory', 'categories'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(SubCategoryUpdateRequest $request, SubCategory $subCategory): RedirectResponse
  {
    $subCategory->name = $request->name;
    $subCategory->category_id = $request->category;
    $subCategory->save();

    NotificationService::UPDATED();

    return to_route('admin.sub-categories.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(SubCategory $subCategory)
  {
    try {
      $subCategory->delete();

      NotificationService::DELETED();
      return response()->json([
        'status' => 'success',
        'message' => __('Sub Category deleted successfully.')
      ], 200);
    } catch (Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => $e->getMessage()
      ]);
    }
  }
}

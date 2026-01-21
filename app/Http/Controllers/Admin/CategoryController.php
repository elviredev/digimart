<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Models\Category;
use App\Services\NotificationService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(): View
  {
    $categories = Category::paginate(25);
    return view('admin.category.index', compact('categories'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(): View
  {
    return view('admin.category.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(CategoryStoreRequest $request)
  {
    // Créer nouvelle instance de Category
    $category = new Category();
    $category->icon = $request->icon;
    $category->name = $request->name;
    $category->slug = Str::slug($request->name);
    $category->file_types = explode(',', $request->file_types);
    $category->show_at_nav = $request->show_at_nav;
    $category->show_at_featured = $request->show_at_featured;
    $category->save();

    NotificationService::CREATED();

    return to_route('admin.categories.index');
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Category $category): View
  {
    return view('admin.category.edit', compact('category'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(CategoryUpdateRequest $request, Category $category)
  {
    $category->icon = $request->icon;
    $category->name = $request->name;
    $category->slug = Str::slug($request->name);
    $category->file_types = explode(',', $request->file_types);
    $category->show_at_nav = $request->show_at_nav;
    $category->show_at_featured = $request->show_at_featured;
    $category->save();

    NotificationService::UPDATED();

    return to_route('admin.categories.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Category $category)
  {
    try {
      $category->delete();

      NotificationService::DELETED();
      return response()->json([
        'status' => 'success',
        'message' => __('Category deleted successfully.')
      ], 200);
    } catch (Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => $e->getMessage()
      ]);
    }
  }
}

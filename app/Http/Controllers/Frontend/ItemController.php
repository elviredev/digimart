<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ItemController extends Controller
{
  /**
  * Display a listing of the resource.
  */
  public function index(): View
  {
    $categories = Category::all();
    return view('frontend.dashboard.item.index', compact('categories'));
  }

  /**
  * Show the form for creating a new resource.
  */
  public function create(Request $request)
  {
    $categories = Category::all();
    $selectedCategory = Category::with('subCategories')->whereSlug($request->category)->firstOrFail();

    return view('frontend.dashboard.item.create', compact('selectedCategory', 'categories'));
  }

  public function itemUploads(Request $request)
  {
    dd($request->all());
  }
}




















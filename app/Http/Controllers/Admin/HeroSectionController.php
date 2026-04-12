<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use App\Models\Item;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class HeroSectionController extends Controller implements HasMiddleware
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
    $hero = HeroSection::first();
    $featuredItemsOne = Item::select(['id', 'name'])->whereIn('id', $hero->featured_items_one)->get();
    $featuredItemsTwo = Item::select(['id', 'name'])->whereIn('id', $hero->featured_items_two)->get();

    return view('admin.sections.hero.index', compact('hero', 'featuredItemsOne', 'featuredItemsTwo'));
  }

  /**
   * Display a listing of the resource for search in selects fields
   */
  public function productSearch(Request $request): JsonResponse
  {
    $search = $request->q;
    $page = $request->page ?? 1;

    $products = Item::with('author:id,name')
      ->select([
        'id',
        'name',
        'author_id',
        'preview_type',
        'preview_image',
        'preview_video',
        'preview_audio'
      ])
      ->whereStatus('approved')
      ->where('name', 'LIKE', "%{$search}%")
      ->paginate(15)->withQueryString();

    return response()->json([
      'results' => $products->items(),
      'pagination' => [
        'more' => $products->hasMorePages()
      ],
      'total_count' => $products->total(),
      'page' => $page,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $request->validate([
      'title' => ['required', 'string', 'max:255'],
      'subtitle' => ['required', 'string', 'max:1000'],
      'featured_items_one' => ['nullable', 'array'],
      'featured_items_two' => ['nullable', 'array']
    ]);

    HeroSection::updateOrCreate(
      ['id' => 1],
      [
        'title' => $request->title,
        'subtitle' => $request->subtitle,
        'featured_items_one' => $request->featured_items_one,
        'featured_items_two' => $request->featured_items_two,
      ]
    );

    NotificationService::UPDATED();

    return redirect()->back();
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}

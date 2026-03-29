<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FeaturedAuthorSection;
use App\Models\FeaturedCategory;
use App\Models\HeroSection;
use App\Models\HighlightedProduct;
use App\Models\Item;
use App\Models\MonthlyPickedProduct;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
  public function index(): View
  {
    // Get hero section data
    $heroSection = HeroSection::first();

    // Get featured categories
    $featuredCategories = Category::withCount(['items' => function($query) {
      $query->where('status', 'approved');
    }])->where('show_at_featured', 1)->get();

    // Filter products by featured sub-categories
    $subCategory = FeaturedCategory::first()?->category_ids;
    $featuredItems = Item::whereIn('sub_category_id', $subCategory)
      ->withCount(['sales', 'reviews'])
      ->withAvg('reviews', 'stars')
      ->where('status', 'approved')
      ->with('subCategory:id,name')
      ->latest()
      ->take(8 * count($subCategory))
      ->get()
      ->groupBy(fn($item) => $item->subCategory->name);

    // Get highlighted products
    $highlightedProductSection = HighlightedProduct::first();
    $highlightedProducts = Item::whereIn('id', $highlightedProductSection->item_ids)
      ->withCount(['sales', 'reviews'])
      ->withAvg('reviews', 'stars')
      ->where('status', 'approved')
      ->take(4)
      ->get();

    // Get monthly picked products
    $monthlyPickedProductSection = MonthlyPickedProduct::first();
    $monthlyPickedProducts = Item::whereIn('id', $monthlyPickedProductSection->item_ids)
      ->withCount(['sales', 'reviews'])
      ->withAvg('reviews', 'stars')
      ->where('status', 'approved')
      ->take(8)
      ->get();

    // Get Featured Author Products
    $featuredAuthorSection = FeaturedAuthorSection::first();
    $featuredAuthorProducts = Item::where('author_id', $featuredAuthorSection->author_id)
      ->latest()
      ->take(4)
      ->get();

    return view(
      'frontend.home.index',
      compact(
        'heroSection',
        'featuredCategories',
        'featuredItems',
        'highlightedProductSection',
        'highlightedProducts',
        'monthlyPickedProductSection',
        'monthlyPickedProducts',
        'featuredAuthorSection',
        'featuredAuthorProducts'
      )
    );
  }

  public function highlightedProducts(): View
  {
    $highlightedProductSection = HighlightedProduct::first();
    $highlightedProducts = Item::whereIn('id', $highlightedProductSection->item_ids)
      ->withCount(['sales', 'reviews'])
      ->withAvg('reviews', 'stars')
      ->where('status', 'approved')
      ->paginate(12);

    return view('frontend.pages.highlighted-products', compact('highlightedProducts'));
  }
}

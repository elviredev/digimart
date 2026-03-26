<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FeaturedCategory;
use App\Models\HeroSection;
use App\Models\Item;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
  public function index(): View
  {
    $heroSection = HeroSection::first();

    $featuredCategories = Category::withCount(['items' => function($query) {
      $query->where('status', 'approved');
    }])->where('show_at_featured', 1)->get();

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

    return view('frontend.home.index', compact('heroSection', 'featuredCategories', 'featuredItems'));
  }
}

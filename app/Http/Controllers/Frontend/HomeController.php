<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HeroSection;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
  public function index(): View
  {
    $heroSection = HeroSection::first();
    $featuredCategories = Category::withCount(['items' => function($query) {
      $query->where('status', 'approved');
    }])->where('show_at_featured', 1)->get();
    return view('frontend.home.index', compact('heroSection', 'featuredCategories'));
  }
}

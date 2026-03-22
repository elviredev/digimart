<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemComment;
use App\Models\ItemReview;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  public function index(Request $request): View
  {
    $query = Item::query();
    $query->withCount(['sales', 'reviews']);
    $query->withAvg('reviews', 'stars');
    $query->where('status', 'approved');
    // filtrer les produits en fonction de la catégorie
    $query->when($request->filled('category'), function ($query) use ($request) {
      $query->whereHas('category', function ($query) use ($request) {
        $query->whereSlug($request->category);
      });
    });
    $products = $query->get();

    // total des produits approuvés
    $productsCount = Item::where('status', 'approved')->count();

    // nombre de produits par note
    $productCountByRating = ItemReview::selectRaw('ROUND(stars) as rating, COUNT(*) as count')
      ->groupBy('rating')
      ->pluck('count', 'rating');

    // total des produits approuvés par catégorie
    $categories = Category::withCount(['items' => function ($query) { // ICI
      $query->where('status', 'approved');
    }])->get();

    return view('frontend.pages.products', compact('products', 'categories', 'productsCount', 'productCountByRating'));
  }

  public function show(string $slug): View
  {
    $product = Item::withCount(['comments', 'reviews', 'sales'])->where('slug', $slug)->whereStatus('approved')->firstOrFail();

    $comments = ItemComment::where('item_id', $product->id)->paginate();
    $reviews = ItemReview::where('item_id', $product->id)->paginate();

    return view('frontend.pages.product-details', compact('product', 'comments', 'reviews'));
  }
}

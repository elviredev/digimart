<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemComment;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
  public function index(): View
  {
    $query = Item::query();
    $query->where('status', 'approved');
    $products = $query->get();

    return view('frontend.pages.products', compact('products'));
  }

  public function show(string $slug): View
  {
    $product = Item::where('slug', $slug)->whereStatus('approved')->firstOrFail();
    $comments = ItemComment::where('item_id', $product->id)->paginate();

    return view('frontend.pages.product-details', compact('product', 'comments'));
  }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeaturedAuthorSection;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class FeaturedAuthorSectionController extends Controller implements HasMiddleware
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
    $authors = User::where(['user_type' => 'author', 'kyc_status' => 1])->get();
    $featuredAuthor = FeaturedAuthorSection::first();
    return view('admin.sections.featured-author.index', compact('authors', 'featuredAuthor'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $request->validate([
      'title' => ['required', 'string', 'max:255'],
      'subtitle' => ['required', 'string', 'max:255'],
      'author' => ['required', 'numeric', 'exists:users,id']
    ]);

    FeaturedAuthorSection::updateOrCreate(
      ['id' => 1],
      [
        'title' => $request->title,
        'subtitle' => $request->subtitle,
        'author_id' => $request->author
      ]
    );

    NotificationService::UPDATED();

    return back();
  }

}

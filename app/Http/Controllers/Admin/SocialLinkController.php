<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use App\Services\NotificationService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class SocialLinkController extends Controller implements HasMiddleware
{
  /** Middleware for Permission Manage Socials */
  public static function middleware(): array
  {
    return [
      new Middleware('permission:manage socials')
    ];
  }

  /**
   * Display a listing of the resource.
   */
  public function index(): View
  {
    $socialLinks = SocialLink::all();
    return view('admin.social-link.index', compact('socialLinks'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(): View
  {
    return view('admin.social-link.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request): RedirectResponse
  {
    $request->validate([
      'icon' => ['required', 'string', 'max:255'],
      'url' => ['required', 'url'],
    ]);

    // Store data in the database
    $link = new SocialLink();
    $link->icon = $request->icon;
    $link->url = $request->url;
    $link->save();

    NotificationService::CREATED();

    return to_route('admin.social-links.index');
  }


  /**
   * Show the form for editing the specified resource.
   */
  public function edit(SocialLink $socialLink): View
  {
    return view('admin.social-link.edit', compact('socialLink'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $request->validate([
      'icon' => ['required', 'string', 'max:255'],
      'url' => ['required', 'url'],
    ]);

    // Update data in the database
    $link = SocialLink::findOrFail($id);
    $link->icon = $request->icon;
    $link->url = $request->url;
    $link->save();

    NotificationService::UPDATED();

    return to_route('admin.social-links.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(SocialLink $socialLink)
  {
    try {
      $socialLink->delete();

      NotificationService::DELETED();

      return response()->json([
        'status' => 'success',
        'message' => __('Social Link deleted successfully.')
      ], 200);
    } catch (Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => $e->getMessage()
      ]);
    }
  }
}

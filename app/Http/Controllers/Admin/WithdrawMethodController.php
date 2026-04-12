<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WithdrawMethodStoreRequest;
use App\Models\WithdrawMethod;
use App\Services\NotificationService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class WithdrawMethodController extends Controller implements HasMiddleware
{
  /** Middleware for Permission Manage Withdraw Method */
  public static function middleware(): array
  {
    return [
      new Middleware('permission:manage withdraw method')
    ];
  }

  /**
   * Display a listing of the resource.
   */
  public function index(): View
  {
    $methods = WithdrawMethod::all();
    return view('admin.withdraw-method.index', compact('methods'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(): View
  {
    return view('admin.withdraw-method.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(WithdrawMethodStoreRequest $request)
  {
    $method = new WithdrawMethod();
    $method->name = $request->name;
    $method->minimum_amount = $request->minimum_amount;
    $method->maximum_amount = $request->maximum_amount;
    $method->description = $request->description;
    $method->status = $request->status;
    $method->save();

    NotificationService::CREATED();

    return to_route('admin.withdrawal-methods.index');
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(WithdrawMethod $withdrawalMethod): View
  {
    return view('admin.withdraw-method.edit', compact('withdrawalMethod'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(WithdrawMethodStoreRequest $request, WithdrawMethod $withdrawalMethod)
  {
    $withdrawalMethod->name = $request->name;
    $withdrawalMethod->minimum_amount = $request->minimum_amount;
    $withdrawalMethod->maximum_amount = $request->maximum_amount;
    $withdrawalMethod->description = $request->description;
    $withdrawalMethod->status = $request->status;
    $withdrawalMethod->save();

    NotificationService::UPDATED();

    return to_route('admin.withdrawal-methods.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(WithdrawMethod $withdrawalMethod)
  {
    try {
      $withdrawalMethod->delete();

      NotificationService::DELETED();

      return response()->json([
        'status' => 'success',
        'message' => __('Withdraw Method deleted successfully.')
      ], 200);
    } catch (Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => $e->getMessage()
      ]);
    }
  }
}

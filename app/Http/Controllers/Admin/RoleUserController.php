<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleUserStoreRequest;
use App\Http\Requests\Admin\RoleUserUpdateRequest;
use App\Models\Admin;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use Throwable;

class RoleUserController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(): View
  {
    $admins = Admin::all();
    return view('admin.access-management.role-user.index', compact('admins'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(): View
  {
    $roles = Role::all();
    return view('admin.access-management.role-user.create', compact('roles'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(RoleUserStoreRequest $request): RedirectResponse
  {
    $admin = new Admin();
    $admin->name = $request->name;
    $admin->email = $request->email;
    $admin->password = bcrypt($request->password);
    $admin->save();

    // assigner le role au nouvel admin
    $admin->assignRole($request->role);

    NotificationService::CREATED();

    return to_route('admin.role-users.index');
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Admin $role_user): View
  {
    $roles = Role::all();
    $admin = $role_user;
    return view('admin.access-management.role-user.edit', compact('admin', 'roles'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(RoleUserUpdateRequest $request, Admin $role_user): RedirectResponse
  {
    $admin = $role_user;
    $admin->name = $request->name;
    $admin->email = $request->email;
    if ($request->has('password') && $request->filled('password')) $admin->password = bcrypt($request->password);
    $admin->save();

    // assigner le role au nouvel admin
    $admin->assignRole($request->role);

    NotificationService::UPDATED();

    return to_route('admin.role-users.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Admin $role_user): JsonResponse
  {
    try {
      // remove role from user
      foreach ($role_user->getRoleNames() as $role) {
        $role_user->removeRole($role);
      }
      // delete user
      $role_user->delete();

      NotificationService::DELETED();
    } catch (Throwable $th) {
      return response()->json(['status' => 'error', 'message' => $th->getMessage()], 400);
    }

    return response()->json([
      'status' => 'success',
      'message' => __('Role User deleted successfully.')
    ], 200);
  }
}

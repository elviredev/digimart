<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Artisan;

class WipeDatabaseController extends Controller
{
  public function index(): View
  {
    return view('admin.wipe-database.index');
  }

  /**
   * Handles the process of wiping the database and seeding it with initial data.
   *
   * Executes the `migrate:fresh --seed` Artisan command to reset the database
   * and repopulate it with seed data. If the operation is successful, it returns
   * a success response. In case of failure, it logs the exception and returns an
   * error response.
   *
   * @return \Illuminate\Http\JsonResponse JSON response indicating the status of the operation.
   */
  public function destroy()
  {
    try {
      // Wipe the database
      Artisan::call('migrate:fresh --seed');

      return response()->json([
        'status' => 'success',
        'message' => 'Database wiped successfully'
      ]);
    } catch (\Exception $e) {
      logger($e);
      return response()->json([
        'status' => 'error',
        'message' => $e
      ]);
    }
  }
}

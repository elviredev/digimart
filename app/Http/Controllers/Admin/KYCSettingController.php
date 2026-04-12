<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KycSettingUpdateRequest;
use App\Models\KycSetting;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class KYCSettingController extends Controller implements HasMiddleware
{
  /** Middleware for Permission Manage KYC */
  public static function middleware(): array
  {
    return [
      new Middleware('permission:manage kyc')
    ];
  }

  /**
   * @desc afficher la page KycSetting
   * @return View
   */
  public function index(): View
  {
    $kycSetting = KycSetting::firstOrCreate(['id' => 1]);
    return view('admin.kyc.kyc-setting.index', compact('kycSetting'));
  }

  /**
   * @desc mettre à jour l'enregistrement en bdd
   * @param KycSettingUpdateRequest $request
   * @return RedirectResponse
   */
  public function update(KycSettingUpdateRequest $request): RedirectResponse
  {
    KycSetting::updateOrCreate(
      // si id 1 existe => update sinon create
      ['id' => 1],
      $request->validated()
    );

    NotificationService::UPDATED();

    return redirect()->back();
  }
}

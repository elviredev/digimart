<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KycSettingUpdateRequest;
use App\Models\KycSetting;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class KYCSettingController extends Controller
{
  /**
   * @desc afficher la page KycSetting
   * @return View
   */
  public function index(): View
  {
    $kycSetting = KycSetting::first();
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

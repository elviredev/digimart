<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GeneralSettingUpdateRequest;
use App\Models\Setting;
use App\Services\NotificationService;
use App\Services\SettingService;
use App\Traits\FileUploadTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SettingController extends Controller
{
  use FileUploadTrait;

  public function index(): View
  {
    return view('admin.setting.pages.general-setting');
  }

  public function updateGeneralSettings(GeneralSettingUpdateRequest $request): RedirectResponse
  {
    // Récupérer les données validées
    $validatedData = $request->validated();

    // Insérer ou mettre à jour les données dans la table settings
    foreach ($validatedData as $key => $value) {
      Setting::updateOrCreate(
        ['key' => $key],
        ['value' => $value]
      );
    }

    // Créer une nouvelle instance de SettingService
    $setting = app()->make(SettingService::class);
    // Vider le cache
    $setting->clearCashedSettings();

    NotificationService::UPDATED();

    return redirect()->back();
  }

  public function commissionSettings(): View
  {
    return view('admin.setting.pages.commission-setting');
  }

  public function updateCommissionSettings(Request $request)
  {
    $validatedData = $request->validate([
      'author_commission' => ['required', 'numeric']
    ]);

    // Insérer ou mettre à jour les données dans la table settings
    foreach ($validatedData as $key => $value) {
      Setting::updateOrCreate(
        ['key' => $key],
        ['value' => $value]
      );
    }

    // Créer une nouvelle instance de SettingService
    $setting = app()->make(SettingService::class);
    // Vider le cache
    $setting->clearCashedSettings();

    NotificationService::UPDATED();

    return redirect()->back();
  }

  public function logoSettings(): View
  {
    return view('admin.setting.pages.logo-setting');
  }

  public function updateLogoSettings(Request $request): RedirectResponse
  {
    $validatedData = $request->validate([
      'logo' => ['nullable', 'image', 'max:2048'],
      'footer_logo' => ['nullable', 'image', 'max:2048'],
      'favicon' => ['nullable', 'image', 'max:2048'],
      'breadcrumb' => ['nullable', 'image', 'max:2048'],
    ]);

    if ($request->hasFile('logo')) {
      $validatedData['logo'] = $this->uploadFile($request->file('logo'));
    }

    if ($request->hasFile('footer_logo')) {
      $validatedData['footer_logo'] = $this->uploadFile($request->file('footer_logo'));
    }

    if ($request->hasFile('favicon')) {
      $validatedData['favicon'] = $this->uploadFile($request->file('favicon'));
    }

    if ($request->hasFile('breadcrumb')) {
      $validatedData['breadcrumb'] = $this->uploadFile($request->file('breadcrumb'));
    }

    // Insérer ou mettre à jour les données dans la table settings
    foreach ($validatedData as $key => $value) {
      Setting::updateOrCreate(
        ['key' => $key],
        ['value' => $value]
      );
    }

    // Créer une nouvelle instance de SettingService
    $setting = app()->make(SettingService::class);
    // Vider le cache
    $setting->clearCashedSettings();

    NotificationService::UPDATED();

    return redirect()->back();
  }
}

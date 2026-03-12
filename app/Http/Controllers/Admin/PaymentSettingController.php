<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaypalSettingUpdateRequest;
use App\Http\Requests\Admin\StripeSettingUpdateRequest;
use App\Models\Setting;
use App\Services\NotificationService;
use App\Services\SettingService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PaymentSettingController extends Controller
{
  public function index(): View
  {
    return view('admin.payment-setting.pages.paypal-setting');
  }

  public function updatePaypalSettings(PaypalSettingUpdateRequest $request): RedirectResponse
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

  public function stripeSettings(): View
  {
    return view('admin.payment-setting.pages.stripe-setting');
  }

  public function updateStripeSettings(StripeSettingUpdateRequest $request): RedirectResponse
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
}

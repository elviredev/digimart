<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\KycVerificationStoreRequest;
use App\Models\KycSetting;
use App\Models\KycVerification;
use App\Services\NotificationService;
use App\Traits\FileUploadTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class KycVerificationController extends Controller
{
  use FileUploadTrait;

  /**
   * @desc afficher la page kyc verification
   * @return View
   */
  public function index(): View
  {
    $kycSetting = KycSetting::first();
    return view('frontend.pages.kyc', compact('kycSetting'));
  }

  public function store(KycVerificationStoreRequest $request): RedirectResponse
  {
    $kyc = new KycVerification();
    $kyc->user_id = Auth::guard('web')->user()->id;
    $kyc->document_type = $request->document_type;
    $kyc->document_number = $request->document_number;

    if ($request->hasFile('documents')) {
      $paths = [];
      foreach ($request->file('documents') as $file) {
        $paths[] = $this->uploadFile($file, disk: 'local');
      }
    }

    $kyc->documents = json_encode($paths);
    $kyc->save();

    NotificationService::CREATED(__('Your KYC verification has been submitted successfully 👍'));

    return to_route('dashboard');
  }
}

<?php

use App\Models\KycVerification;
use Illuminate\Support\Facades\Auth;

/** get logged in user */
if (!function_exists('user')) {
  function user() {
    return Auth::guard('web')->user();
  }
}

/** get pending kyc count */
if (!function_exists('pendingKycCount')) {
  function pendingKycCount(): int
  {
    return KycVerification::whereStatus('pending')->count();
  }
}

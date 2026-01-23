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

/** check if it's author */
if (!function_exists('isAuthor')) {
  function isAuthor(): bool
  {
    return user()->user_type == 'author' && user()->kyc_status == 1;
  }
}

/** Format Date */
if (!function_exists('formatDate')) {
  function formatDate(string $date): string
  {
    return date('M d, Y', strtotime($date));
  }
}

/** Check Permissions */
if (!function_exists('canAccess')) {
  function canAccess(array $permissions): bool
  {
    $permission = auth()->guard('admin')->user()->hasAnyPermission($permissions);
    $superAdmin = auth()->guard('admin')->user()->hasRole('super admin');

    if($permission || $superAdmin) return true;

    return false;
  }
}



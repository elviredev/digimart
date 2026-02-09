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

  /** Get human readable size from bytes */
  if (!function_exists('formatSize')) {
    function formatSize($bytes, $decimalPlaces = 2)
    {
      if ($bytes < 0) {
        return 0;
      }
      $sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
      $factor = floor((strlen($bytes) - 1) / 3);
      $formattedSize = $bytes / pow(1024, $factor);

      return round($formattedSize, $decimalPlaces) . $sizes[$factor];
    }
  }

  /** Get icon for file type */
  if (!function_exists('getIcon')) {
    function getIcon($mimeType): string
    {
      $fileIcon = 'bi-file-earmark';

      if(str_starts_with($mimeType, 'image/')) $fileIcon = 'bi-file-earmark-image';
      else if(str_starts_with($mimeType, 'video/')) $fileIcon = 'bi-file-earmark-play';
      else if(str_starts_with($mimeType, 'audio/')) $fileIcon = 'bi-file-earmark-music';
      else if(str_ends_with($mimeType, 'pdf')) $fileIcon = 'bi-file-earmark-pdf';
      else if(str_starts_with($mimeType, 'text/')) $fileIcon = 'bi-file-earmark-text';
      else if(str_starts_with($mimeType, 'application/')) $fileIcon = 'bi-file-earmark-zip';

      return $fileIcon;
    }
  }
}



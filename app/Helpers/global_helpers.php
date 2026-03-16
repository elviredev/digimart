<?php

use App\Models\CartItem;
use App\Models\Item;
use App\Models\KycVerification;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

/** get logged in user */
if (!function_exists('user')) {
  function user() {
    return Auth::guard('web')->user();
  }
}

/** get logged in admin */
if (!function_exists('admin')) {
  function admin() {
    return Auth::guard('admin')->user();
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

  /** Check author, product, status */
  if (!function_exists('authorProductStatus')) {
    function authorProductStatus(string $product_id): string | bool
    {
      $item = Item::where('id', $product_id)->where('author_id', user()->id)->first();
      if($item) return $item->status;
      return false;
    }
  }

  /** Get item status count */
  if (!function_exists('getItemStatusCount')) {
    function getItemStatusCount(string $status): int
    {
      return Item::select('status')->where('status', $status)->count();
    }
  }

  /** Get file size */
  if (!function_exists('getFileSize')) {
    function getFileSize(string $path): ?string
    {
      try {
        return formatSize(File::size(storage_path('app/private/' . $path)));
      } catch (\Exception $e) {
        return '0B';
      }
    }
  }

  /** Get cart count */
  if (!function_exists('getCartCount')) {
    function getCartCount(): int
    {
      return CartItem::where('user_id', user()->id)->count();
    }
  }

  /** Get cart total */
  if (!function_exists('getCartTotal')) {
    function getCartTotal(): int | float
    {
      $total = 0;
      $cartItems = CartItem::where('user_id', user()->id)->get();

      foreach($cartItems as $cartItem) {
        if ($cartItem->item->discount_price > 0) {
          $total += $cartItem->item->discount_price;
        } else {
          $total += $cartItem->item->price;
        }
      }

      return $total;
    }
  }

  /** Get cart items */
  if (!function_exists('getCartItems')) {
    function getCartItems(): Collection
    {
      return CartItem::where('user_id', user()->id)->get();
    }
  }

  /** Get currency position */
  if (!function_exists('currencyPosition')) {
    function currencyPosition($amount): string
    {
      return config('settings.currency_position') == 'right'
        ? $amount . config('settings.currency_icon')
        : config('settings.currency_icon') . $amount;
    }
  }
}



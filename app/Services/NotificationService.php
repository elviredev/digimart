<?php

namespace App\Services;

class NotificationService
{
  static function CREATED($message = null)
  {
    notyf()->success($message ?? __('Created successfully 😊'));
  }

  static function UPDATED($message = null)
  {
    notyf()->success($message ??  __('Updated successfully 😊'));
  }

  static function DELETED($message = null)
  {
    notyf()->success($message ??  __('Deleted successfully 😊'));
  }

  static function ERROR($message = null)
  {
    notyf()->error($message ??  __('Something went wrong 😵'));
  }
}
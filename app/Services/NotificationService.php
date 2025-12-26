<?php

namespace App\Services;

class NotificationService
{
  private static $createMessage = 'Created successfully 😊';
  private static $updateMessage = 'Updated successfully 😊';
  private static $deleteMessage = 'Deleted successfully 😊';
  private static $errorMessage = 'Something went wrong 😵';

  static function CREATED($message = null)
  {
    notyf()->success($message ?? self::$createMessage);
  }

  static function UPDATED($message = null)
  {
    notyf()->success($message ?? self::$updateMessage);
  }

  static function DELETED($message = null)
  {
    notyf()->success($message ?? self::$deleteMessage);
  }

  static function ERROR($message = null)
  {
    notyf()->error($message ?? self::$errorMessage);
  }
}
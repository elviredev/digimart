<?php

namespace App\Providers;

use App\Services\SettingService;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{


  /**
   * Register services.
   */
  public function register(): void
  {
    $this->app->singleton(SettingService::class, function () {
      return new SettingService();
    });
  }

  /**
   * Bootstrap services.
   */
  public function boot(): void
  {
    $setting = $this->app->make(SettingService::class);
    $setting->setSettings();

    //SMTP Configuration
    config(['mail.mailers.smtp.host' => config('settings.smtp_mail_host')]);
    config(['mail.mailers.smtp.port' => config('settings.smtp_port')]);
    config(['mail.mailers.smtp.username' => config('settings.smtp_user_name')]);
    config(['mail.mailers.smtp.password' => config('settings.smtp_user_password')]);
  }
}

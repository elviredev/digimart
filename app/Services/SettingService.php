<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingService
{
  /**
   * Récupérer les données soit depuis le cache, soit depuis la BDD si le cache n’existe pas encore
   */
  function getSettings()
  {
    return Cache::rememberForever('settings', function () {
      return Setting::pluck('value', 'key')->toArray();
    });
  }

  /**
   * Injecte les paramètres dans la configuration Laravel,
   * afin de pouvoir les utiliser partout avec `config()`
   */
  public function setSettings()
  {
    $settings = $this->getSettings();
    config()->set('settings', $settings);
  }

  /**
   * Supprimer les paramètres du cache
   * @return void
   */
  public function clearCashedSettings(): void
  {
    Cache::forget('settings');
  }
}
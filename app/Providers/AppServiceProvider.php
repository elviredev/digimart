<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    // vérifier le rôle souhaité
    // Accorder implicitement toutes les permissions au rôle « Super Administrateur »
    // Ceci fonctionne dans l'application grâce à des fonctions de contrôle d'accès telles que auth()->user->can() et @can()
    Gate::before(function ($user, $ability) {
      return $user->hasRole('super admin') ? true : null;
    });
  }
}

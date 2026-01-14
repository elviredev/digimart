<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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
    // bootstrap paginator
    Paginator::useBootstrapFive();

    // Accorder implicitement toutes les permissions au rôle « Super Administrateur »
    // Ceci fonctionne dans l'application grâce à des fonctions de contrôle d'accès telles que auth()->user->can() et @can()
    Gate::before(function ($user, $ability) {
      return $user->hasRole('super admin') ? true : null;
    });
  }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  /** @use HasFactory<UserFactory> */
  use HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
    'kyc_status',
    'user_type',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var list<string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  // accesseur pour formater le montant du solde
  public function getBalanceFormattedAttribute()
  {
    return number_format($this->balance, 2, '.', '');
  }

  /**
   * User peut avoir plusieurs demandes de vérifications kyc
   */
  public function kyc(): HasMany
  {
    return $this->hasMany(KycVerification::class, 'user_id', 'id')->orderBy('created_at', 'desc');
  }

  /**
   * User peut avoir plusieurs produits
   */
  public function products(): HasMany
  {
    return $this->hasMany(Item::class, 'author_id', 'id')->where('status', 'approved');
  }

  /**
   * User dispose d'une information de retrait
   */
  public function authorWithdrawInfo(): HasOne
  {
    return $this->hasOne(AuthorWithdrawInformation::class, 'author_id', 'id');
  }

  /**
   * Obtenir les demandes de retrait d'un auteur spécifique
   */
  public function withdraws(): HasMany
  {
    return $this->hasMany(Withdraw::class, 'author_id', 'id')->orderBy('created_at', 'desc');
  }

  /**
   * Obtenir les informations sur les ventes d'un auteur spécifique
   */
  public function authorSales(): HasMany
  {
    return $this->hasMany(AuthorSale::class, 'author_id', 'id');
  }

  /**
   * Obtenir les achats d'un utilisateur
   */
  public function purchaseItems(): HasMany
  {
    return $this->hasMany(PurchaseItem::class, 'user_id');
  }
}

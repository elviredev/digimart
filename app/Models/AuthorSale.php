<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuthorSale extends Model
{
  public function item(): BelongsTo
  {
    return $this->belongsTo(Item::class, 'item_id', 'id');
  }

  // accesseur pour formater le prix
  public function getAuthorEarningFormattedAttribute()
  {
    return number_format($this->author_earning, 2, '.', '');
  }

  // accesseur pour formater le montant retenu par le site web
  public function getPlatformEarningFormattedAttribute()
  {
    return number_format($this->amount - $this->author_earning, 2, '.', '');
  }

  // accesseur pour formater le montant de la vente
  public function getAmountFormattedAttribute()
  {
    return number_format($this->amount, 2, '.', '');
  }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Withdraw extends Model
{
  // accesseur pour formater le montant
  public function getAmountFormattedAttribute()
  {
    return number_format($this->amount, 2, '.', '');
  }

  public function author(): BelongsTo
  {
    return $this->belongsTo(User::class, 'author_id', 'id');
  }
}

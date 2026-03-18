<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
  // accesseur pour formater le montant
  public function getAmountFormattedAttribute()
  {
    return number_format($this->amount, 2, '.', '');
  }
}

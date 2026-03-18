<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawMethod extends Model
{
  // accesseur pour formater le montant minimum
  public function getMinimumAmountFormattedAttribute()
  {
    return number_format($this->minimum_amount, 2, '.', '');
  }

  // accesseur pour formater le montant maximum
  public function getMaximumAmountFormattedAttribute()
  {
    return number_format($this->maximum_amount, 2, '.', '');
  }
}

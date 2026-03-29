<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyPickedProduct extends Model
{
  protected $fillable = ['id', 'title', 'description', 'item_ids'];
  protected $casts = ['item_ids' => 'array'];
}

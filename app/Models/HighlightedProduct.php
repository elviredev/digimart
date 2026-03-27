<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HighlightedProduct extends Model
{
  protected $fillable = ['id', 'title', 'subtitle', 'item_ids'];
  protected $casts = ['item_ids' => 'array'];
}

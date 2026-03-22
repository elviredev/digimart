<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
  protected $casts = [
    'file_types' => 'array',
  ];

  public function subCategories(): HasMany
  {
    return $this->hasMany(SubCategory::class, 'category_id');
  }

  public function items(): HasMany
  {
    return $this->hasMany(Item::class, 'category_id', 'id');
  }
}


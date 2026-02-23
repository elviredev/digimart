<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Item extends Model
{
  use HasSlug;

  /**
   * Get the options for generating the slug.
   */
  public function getSlugOptions() : SlugOptions
  {
    return SlugOptions::create()
      ->generateSlugsFrom('name')
      ->saveSlugsTo('slug');
  }

  public function category(): BelongsTo
  {
    return $this->belongsTo(Category::class);
  }

  public function subCategory(): BelongsTo
  {
    return $this->belongsTo(SubCategory::class);
  }

  public function author(): BelongsTo
  {
    return $this->belongsTo(User::class, 'author_id', 'id');
  }

  public function histories(): HasMany
  {
    return $this->hasMany(ItemHistory::class, 'item_id')->latest();
  }

  public function changelogs(): HasMany
  {
    return $this->hasMany(ItemChangelog::class, 'item_id')->latest();
  }

  protected $casts = [
    'tags' => 'array',
    'screenshots' => 'array',
  ];

}

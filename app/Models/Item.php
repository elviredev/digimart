<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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

  protected $casts = [
    'tags' => 'array',
    'screenshots' => 'array'
  ];
}

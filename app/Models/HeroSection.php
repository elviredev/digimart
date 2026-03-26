<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
  protected $fillable = [
    'id',
    'title',
    'subtitle',
    'featured_items_one',
    'featured_items_two',
  ];

  protected $casts = [
    'featured_items_one' => 'array',
    'featured_items_two' => 'array',
  ];
}

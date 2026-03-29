<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturedAuthorSection extends Model
{
  protected $fillable = ['id', 'title', 'subtitle', 'author_id'];
}

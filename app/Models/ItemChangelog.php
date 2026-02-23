<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemChangelog extends Model
{
  protected $fillable = [
    'item_id',
    'version',
    'description'
  ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CounterSection extends Model
{
  protected $fillable = [
    'id',
    'title',
    'subtitle',
    'label_one',
    'counter_one',
    'label_two',
    'counter_two',
    'label_three',
    'counter_three',
    'label_four',
    'counter_four'
  ];
}

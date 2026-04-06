<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInfoSection extends Model
{
  protected $fillable = [
    'id',
    'phone_one',
    'phone_two',
    'email_one',
    'email_two',
    'link_one',
    'link_two',
    'map'
  ];
}

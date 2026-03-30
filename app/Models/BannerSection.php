<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerSection extends Model
{
  protected $fillable = [
    'id',
    'background_image_one',
    'banner_title_one',
    'banner_subtitle_one',
    'button_text_one',
    'button_url_one',
    'background_image_two',
    'banner_title_two',
    'banner_subtitle_two',
    'button_text_two',
    'button_url_two'
    ];
}

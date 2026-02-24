<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'logo', 'site_name', 'facebook_url', 'instagram_url', 'youtube_url'
    ];
}

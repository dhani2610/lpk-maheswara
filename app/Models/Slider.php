<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['image', 'label', 'title', 'description', 'is_active'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = ['image', 'content', 'checklists'];

    protected $casts = [
        'checklists' => 'array',
    ];
}

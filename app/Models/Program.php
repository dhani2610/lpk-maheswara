<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = ['cover', 'title', 'short_description', 'content'];
}

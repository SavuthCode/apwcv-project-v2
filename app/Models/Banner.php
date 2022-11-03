<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'photo',
        'banner_type',
        'published',
        'url'
    ];

}

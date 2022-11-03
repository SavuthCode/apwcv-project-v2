<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable =[

        "title_en", "title_kh", "slug", "image", "is_active"
    ];

    public function medias()
    {
    	return $this->hasMany(Medias::class);
    }
}

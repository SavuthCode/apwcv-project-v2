<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medias extends Model
{
    protected $fillable =[
        "title", "description", "data", "type", "is_active", "category_id"
    ];
    public function category()
    {
        return $this->hasMany(Category::class);
    }
}

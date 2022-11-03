<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'first_name','last_name', 'email', 'image', 'password',"phone", "role_id", "is_admin", "is_active"
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Roles::class);
    }

    public function isActive()
    {
        return $this->is_active;
    }

    public function holiday() {
        return $this->hasMany('App\Holiday');
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

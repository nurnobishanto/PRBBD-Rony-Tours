<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    protected string $guard = 'web';

    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'email',
        'phone',
        'password',
        'pass_text',
        'country',
        'country_code',
        'phone',
        'image',
        'company_name',
        'company_logo',
        'trade_licence',
        'passport',
        'passport_no',
        'passport_exp',
        'address',
        'post_code',
        'city',
        'time_zone',
        'balance',
        'dob',
        'gender',
        'user_type',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function supports(): HasMany
    {
        return $this->hasMany(Support::class);
    }
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}

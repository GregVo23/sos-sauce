<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'last_name',
        'first_name',
        'email',
        'birthday',
        'password',
        'api_token',
        'user_token',
        'member_since',
        'about',
        'gender'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function favoriteMeals()
    {
        return $this->belongsToMany(Meal::class);
    }

    public function Meals()
    {
        return $this->hasMany(Meal::class);
    }

    public function favoriteSauces()
    {
        return $this->belongsToMany(Sauce::class);
    }

    public function Sauces()
    {
        return $this->hasMany(Sauce::class);
    }
}

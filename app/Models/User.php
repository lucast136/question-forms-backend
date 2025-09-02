<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User  extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens,HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'DNI',
        'category_users_id',
        'name',
        'last_name',
        'email',
        'password',
        'image',
        'status',
        'is_admin',
        'address',
        'city',
        'postal_code',
        'phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function mains():BelongsToMany
    {
        return $this->belongsToMany(Main::class, 'access_users')
                    ->withTimestamps();
    }

    

    /**
     * Relación con las respuestas calificadas por el usuario
     */
    public function qualifiedAnswers()
    {
        return $this->hasMany(Answer::class, 'user_id_qualifier');
    }
}

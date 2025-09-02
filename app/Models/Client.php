<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'last_name',
        'first_name',
        'email',
        'gender',
        'age',
        'province',
        'user_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'edad' => 'integer',
        'genero' => 'string',
    ];

    /**
     * Relación con el usuario que creó el cliente
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con las respuestas (answers)
     */
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * Scope para filtrar por género
     */
    public function scopeByGenero($query, $genero)
    {
        return $query->where('genero', $genero);
    }

    /**
     * Scope para filtrar por provincia
     */
    public function scopeByProvincia($query, $provincia)
    {
        return $query->where('provincia', $provincia);
    }

    /**
     * Accessor para nombre completo
     */
    public function getNombreCompletoAttribute()
    {
        return $this->nombres . ' ' . $this->apellidos;
    }
}

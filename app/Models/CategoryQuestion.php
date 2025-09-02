<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryQuestion extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];

    protected $hidden = [
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}

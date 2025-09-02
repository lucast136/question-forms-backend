<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryForm extends Model
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

    public function forms(): HasMany
    {
        return $this->hasMany(Form::class);
    }
    public function scoreNorms(): HasMany
    {
        return $this->hasMany(ScoreNorm::class);
    }
}

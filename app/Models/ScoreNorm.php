<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScoreNorm extends Model
{
    protected $fillable = [
        'category_question_id',
        'category_form_id',
        'name',
        'description',
        'min_score',
        'max_score',
        'invalidation_score',
        'html_color',
        'user_id'
    ];

    protected $hidden = [
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
public function categoryQuestion(): BelongsTo
    {
        return $this->belongsTo(CategoryQuestion::class);
    }

}

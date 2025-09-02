<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionOption extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'question_id',
        'question_title',
        'is_correct',
        'weight',
        'user_id'
    ];

    protected $hidden = [
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
        'weight' => 'decimal:2',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }


    /**
     * Relación con las respuestas (answers)
     */
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
}

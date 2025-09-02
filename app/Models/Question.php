<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_question_id',
        'form_section_id',
        'type_control',
        'name',
        'message_error',
        'order',
        'is_required',
        'description',
        'weight',
        'user_id'
    ];
//  // ✅ Ordenamiento por defecto
//     protected $orderBy = [
//         'order' => 'ASC'
//     ];
    protected $hidden = [
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'weight' => 'decimal:2',
    ];

    public function categoryQuestion(): BelongsTo
    {
        return $this->belongsTo(CategoryQuestion::class);
    }

    public function formSection(): BelongsTo
    {
        return $this->belongsTo(FormSection::class);
    }

    public function questionOptions(): HasMany
    {
        return $this->hasMany(QuestionOption::class);
    }
}

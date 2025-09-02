<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_form_id',
        'name',
        'description',
        'status',
        'trieds',
        'published_at',
        'archived_at',
        'user_id'
    ];

    protected $hidden = [
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts = [
        'status' => 'boolean',
    ];
    public function categoryForm(): BelongsTo
    {
        return $this->belongsTo(CategoryForm::class);
    }

    public function formSections(): HasMany
    {
        return $this->hasMany(FormSection::class);
    }

    public function questions():HasManyThrough
    {
        return $this->hasManyThrough(Question::class, FormSection::class);
    }

// ✅ MÉTODO SIMPLE: Contar respuestas usando Query Builder
public function countUserAnswers($clientId)
{
    return Answer::whereHas('questionOption.question.formSection', function($query) {
        $query->where('form_id', $this->id);
    })->where('client_id', $clientId)->count();
}

// ✅ MÉTOD: Obtener todas las respuestas del usuario para este formulario
public function getUserAnswers($clientId)
{
    return Answer::whereHas('questionOption.question.formSection', function($query) {
        $query->where('form_id', $this->id);
    })->where('client_id', $clientId)
      ->with([
          'questionOption',
          'questionOption.question',
          'questionOption.question.formSection'
      ])->get();
}

// ✅ MÉTOD: Verificar si el usuario completó el formulario
public function isCompletedByUser($clientId)
{
    $totalQuestions = $this->questions()->count();
    $answeredQuestions = $this->countUserAnswers($clientId);

    return $totalQuestions > 0 && $answeredQuestions >= $totalQuestions;
}

// ✅ MÉTOD: Obtener porcentaje de completitud
public function getCompletionPercentage($clientId)
{
    $totalQuestions = $this->questions()->count();
    $answeredQuestions = $this->countUserAnswers($clientId);

    return $totalQuestions > 0 ? round(($answeredQuestions / $totalQuestions) * 100, 2) : 0;
}
}

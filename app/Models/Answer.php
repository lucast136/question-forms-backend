<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'question_option_id',
        'client_id',
        'user_id_qualifier',
        'qualified_score',
        'score_auto',
        'ip_client',
        'answer_value',
        'observation',
        'tried',
        'user_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'user_id',
    ];



    /**
     * Relación con la opción de pregunta
     */
    public function questionOption(): BelongsTo
    {
        return $this->belongsTo(QuestionOption::class);
    }

    // /**
    //  * Relación con el cliente
    //  */
    // public function client()
    // {
    //     return $this->belongsTo(Client::class);
    // }

    // /**
    //  * Relación con el usuario que crea la respuesta
    //  */
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // /**
    //  * Relación con el usuario calificador (opcional)
    //  */
    // public function qualifier()
    // {
    //     return $this->belongsTo(User::class, 'user_id_qualifier');
    // }

    // /**
    //  * Scope para filtrar por cliente
    //  */
    // public function scopeByClient($query, $clientId)
    // {
    //     return $query->where('client_id', $clientId);
    // }

    // /**
    //  * Scope para filtrar por calificador
    //  */
    // public function scopeByQualifier($query, $qualifierId)
    // {
    //     return $query->where('user_id_qualifier', $qualifierId);
    // }

    // /**
    //  * Scope para respuestas calificadas
    //  */
    // public function scopeQualified($query)
    // {
    //     return $query->whereNotNull('qualified_score');
    // }

    // /**
    //  * Scope para respuestas auto-calificadas
    //  */
    // public function scopeAutoScored($query)
    // {
    //     return $query->whereNotNull('score_auto');
    // }

    // /**
    //  * Accessor para obtener el puntaje final (prioriza calificado sobre automático)
    //  */
    // public function getFinalScoreAttribute()
    // {
    //     return $this->qualified_score ?? $this->score_auto ?? 0;
    // }

    // /**
    //  * Accessor para determinar si está calificada manualmente
    //  */
    // public function getIsQualifiedAttribute()
    // {
    //     return !is_null($this->qualified_score);
    // }
}

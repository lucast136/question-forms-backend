<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResultsTestByClient extends Model
{
    protected $fillable = [
        'form_id',
        'score_norm_id',
        'client_id',
        'score',
        'total_score'
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function scoreNorm(): BelongsTo
    {
        return $this->belongsTo(ScoreNorm::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}

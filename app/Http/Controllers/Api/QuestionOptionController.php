<?php

namespace App\Http\Controllers\Api;

use Orion\Http\Controllers\RelationController;
use App\Models\Question;
use App\Http\Requests\QuestionOptionRequest;
use Orion\Concerns\DisableAuthorization;

class QuestionOptionController extends RelationController
{
    use DisableAuthorization;

    protected $model = Question::class;
    protected $relation = 'questionOptions';

    public function limit(): int
    {
        return 50;
    }

    public function searchableBy(): array
    {
        return ['question_title'];
    }

    public function filterableBy(): array
    {
        return ['user_id', 'is_correct'];
    }

    protected function request()
    {
        return QuestionOptionRequest::class;
    }

    public function includes(): array
    {
        return ['question', 'questionOptionItems'];
    }
}

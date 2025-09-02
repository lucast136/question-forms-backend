<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CategoryQuestionRequest;
use App\Models\CategoryQuestion;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\Controller;

class CategoryQuestionController extends Controller
{
    use DisableAuthorization;

    protected $model = CategoryQuestion::class;

    public function limit(): int
    {
        return 50;
    }

    public function searchableBy(): array
    {
        return ['name'];
    }

    public function filterableBy(): array
    {
        return ['user_id'];
    }

    protected function request()
    {
        return CategoryQuestionRequest::class;
    }

    public function includes(): array
    {
        return ['questions'];
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ScoreNormRequest;
use App\Models\CategoryForm;
use Illuminate\Database\Eloquent\Relations\Relation;
use Orion\Http\Controllers\RelationController;
use Orion\Concerns\DisableAuthorization;
use Illuminate\Http\Request;

class CategoryFormScoreNormController extends RelationController
{
    use DisableAuthorization;

    protected $model = CategoryForm::class;

    protected $relation = 'scoreNorms';

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
        return ScoreNormRequest::class;
    }

    public function includes(): array
    {
        return ['scoreNorms','scoreNorms.categoryQuestion'];
    }
    public function alwaysIncludes(): array
    {
        return ['categoryQuestion'];
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ScoreNormRequest;
use App\Models\ScoreNorm;
use Illuminate\Http\Request;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\Controller;

class ScoreNormController extends Controller
{
    use DisableAuthorization;

    protected $model = ScoreNorm::class;

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
        return ['questions'];
    }
    public function alwaysIncludes(): array
    {
        return ['categoryQuestion'];
    }
}

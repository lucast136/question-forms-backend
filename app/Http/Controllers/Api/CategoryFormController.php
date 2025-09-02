<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CategoryFormRequest;
use App\Models\CategoryForm;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\Controller;

class CategoryFormController extends Controller
{
    use DisableAuthorization;

    protected $model = CategoryForm::class;

    public function limit(): int
    {
        return 50;
    }

    public function searchableBy(): array
    {
        return ['name','description'];
    }

    public function filterableBy(): array
    {
        return ['user_id'];
    }

    protected function request()
    {
        return CategoryFormRequest::class;
    }

    public function includes(): array
    {
        return ['forms'];
    }
}

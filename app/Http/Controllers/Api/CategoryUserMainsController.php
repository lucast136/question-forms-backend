<?php

namespace App\Http\Controllers\api;

use App\Models\CategoryUser;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\RelationController;

class CategoryUserMainsController extends RelationController
{
    use DisableAuthorization;
    protected $model = CategoryUser::class;

    protected $relation = 'mains';

    public function getRolesByModule($categoryId, $moduleId)
    {
        $categoryUser = CategoryUser::findOrFail($categoryId);
        $roles = $categoryUser->rolesByModule($moduleId)->get();

        return response()->json($roles);

    }
}

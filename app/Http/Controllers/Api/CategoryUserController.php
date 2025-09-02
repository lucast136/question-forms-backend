<?php

namespace App\Http\Controllers\api;

use App\Models\CategoryUser;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\Controller;

class CategoryUserController extends Controller
{
use DisableAuthorization;

protected $model = CategoryUser::class;

public function limit() : int
{
return 50;
}

public function filterableBy():array
{
    return ['name'];
}
public function getRolesByModule($categoryId, $moduleId)
    {
        $categoryUser = CategoryUser::findOrFail($categoryId);
        $roles = $categoryUser->rolesByModule($moduleId)->get();

        return response()->json($roles);

    }

}

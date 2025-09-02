<?php

namespace App\Http\Controllers\api;

use Orion\Concerns\DisableAuthorization;
use App\Models\User;
use Orion\Http\Controllers\RelationController;

class UserMainController extends RelationController
{
    use DisableAuthorization;
    protected $model = User::class;

    protected $relation = 'mains';

    public function limit() : int
    {
    return 200;
    }
    public function getRolesByModule($userId, $moduleId)
    {
        // Intentamos encontrar al usuario con el ID dado
        $categoryUser = User::find($userId);

        // Si no se encuentra el usuario, devolvemos una respuesta vacía o un mensaje personalizado
        if (!$categoryUser) {
            return response()->json([], 404);
        }

        // Si el usuario existe, obtenemos los roles asociados al módulo
        $roles = $categoryUser->mains()->where('module_id', $moduleId)->orderBy('id', 'asc')->get();

        // Devolvemos los roles en formato JSON
        return response()->json($roles);

    }
}

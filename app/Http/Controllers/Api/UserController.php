<?php

namespace App\Http\Controllers\api;

use Orion\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Orion\Concerns\DisableAuthorization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use DisableAuthorization;

    protected $model = User::class;

    public function limit() : int
    {
        return 50;
    }
    protected function request()
    {
        return UserRequest::class;
    }
    public function filterableBy():array
    {
        return ['name','last_name','email'];
    }
    // Método para actualizar la imagen del usuario
    public function updateImage(Request $request, User $user)
    {
        // Validar la imagen
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Tamaño máximo 2MB
        ]);

        // Eliminar la imagen anterior si existe
        if ($user->image) {
            Storage::delete($user->image);
        }

        // Almacenar la nueva imagen
        $path = $request->file('image')->store('images/users');

        // Actualizar el campo `image` en la base de datos
        $user->image = $path;
        $user->save();

        return response()->json([
            'message' => 'Imagen actualizada correctamente.',
            'image' => $path
        ]);
    }
}

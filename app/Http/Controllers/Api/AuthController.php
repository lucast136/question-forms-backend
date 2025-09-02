<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function create(Request $request)
    {
        $rules = [
            'DNI' => 'required|string|min:8|max:15|unique:users',
            'name' => 'required|string|min:1|max:255',
            'last_name' => 'required|string|min:1|max:255',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|min:9',
        ];

        $validator = \Validator::make($request->input(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        };

        $user = User::create([
            'DNI' => $request->DNI,
            'name' => $request->name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'phone' => $request->phone,
            'email' => $request->email,
            'is_admin' => 0,
            'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'User created successfully',
            'data' => $user,
            'token'=> $token
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:100',
            'password' => 'required|string'
        ]);

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1])) {
            throw ValidationException::withMessages([
                'email' => ['Credenciales incorrectas o usuario inactivo']
            ]);
        }

        $user = Auth::user();
        // $token = $user->createToken('API_TOKEN')->plainTextToken;

        // $request->session()->regenerate(); // Genera una nueva sesión segura
        $token = $user->createToken('facturala-web', [
            'expires_at' => now()->addHours(2)
        ])->plainTextToken;
        return response()->json([
            'status' => true,
            'message' => 'User logged in successfully',
            'data' => $user,
            'token'=> $token
        ]);

    }

    public function logout(Request $request)
    {
        // Eliminar token de la base de datos
        $request->user()->currentAccessToken()->delete();

        // Invalidar cookie
        $cookie = Cookie::forget('auth_token');

        return response()->json([
            'status' => true,
            'message' => 'User logged out successfully'
        ])->withCookie($cookie);
    }
}

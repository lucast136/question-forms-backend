<?php

namespace App\Http\Controllers\Api;

use Orion\Http\Controllers\Controller;
use App\Models\Client;
use App\Http\Requests\ClientRequest;
use Orion\Concerns\DisableAuthorization;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    use DisableAuthorization;

    /**
     * Fully-qualified model class name
     */
    protected $model = Client::class;

    /**
     * The number of results to return per page.
     */
    public function limit(): int
    {
        return 50;
    }

    /**
     * The attributes that are used for searching.
     *
     * @return array
     */
    public function searchableBy(): array
    {
        return ['last_name', 'first_name', 'email', 'province'];
    }

    /**
     * The attributes that are used for sorting.
     *
     * @return array
     */
    public function sortableBy(): array
    {
        return ['id', 'last_name', 'first_name', 'email', 'gender', 'age', 'province', 'created_at'];
    }

    /**
     * The attributes that are used for filtering.
     *
     * @return array
     */
    public function filterableBy(): array
    {
        return ['email', 'gender', 'province', 'age'];
    }

    /**
     * The relations that are allowed to be included together with a resource.
     *
     * @return array
     */
    public function includes(): array
    {
        return ['user'];
    }

    /**
     * The request class to use for store and update operations.
     *
     * @return string
     */
    protected function request(): string
    {
        return ClientRequest::class;
    }


    /**
     * Método personalizado para obtener estadísticas de clientes
     */
    public function stats(Request $request)
    {
        $userId = $request->user()->id;

        $stats = [
            'total_clients' => Client::where('user_id', $userId)->count(),
            'by_gender' => [
                'masculino' => Client::where('user_id', $userId)->byGenero('masculino')->count(),
                'femenino' => Client::where('user_id', $userId)->byGenero('femenino')->count(),
            ],
            'by_province' => Client::where('user_id', $userId)
                ->selectRaw('provincia, COUNT(*) as count')
                ->groupBy('provincia')
                ->get()
                ->pluck('count', 'provincia'),
            'age_average' => Client::where('user_id', $userId)->avg('edad'),
            'age_range' => [
                'min' => Client::where('user_id', $userId)->min('edad'),
                'max' => Client::where('user_id', $userId)->max('edad'),
            ]
        ];

        return response()->json([
            'message' => 'Estadísticas de clientes obtenidas exitosamente',
            'data' => $stats
        ]);
    }

}

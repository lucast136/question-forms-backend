<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ResultsTestByClientRequest;
use App\Models\ResultsTestByClient;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\Controller;
use Orion\Http\Requests\Request;

class ResultsTestByClientController extends Controller
{

use DisableAuthorization;

protected $model = ResultsTestByClient::class;
public function limit(): int
    {
        return 50;
    }
  protected function beforeBatchStore(Request $request)
    {
        $resources = $request->all();

        // // obtenemos el primer id del cliente y del form y contamos los registros que existen
        $clientId = $resources['resources'][0]['client_id'];
        $formId = $resources['resources'][0]['form_id'];
        $existingRecords = ResultsTestByClient::where('client_id', $clientId)
            ->where('form_id', $formId)
            ->count();

        // // Si ya existen registros, podemos optar por actualizarlos o rechazarlos
        if ($existingRecords > 0) {
                //cancelamoslo registro que se deben realizar
                abort(409, 'Ya existen registros para este cliente y formulario.');
        }
    }


 protected function request(): string
    {
        return ResultsTestByClientRequest::class;
    }
}

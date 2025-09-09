<?php

namespace App\Http\Controllers\Api;

use Orion\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Client;
use App\Http\Requests\AnswerRequest;
use Orion\Concerns\DisableAuthorization;
use Illuminate\Http\Request;
use App\Mail\TestCompletedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AnswerController extends Controller
{
    use DisableAuthorization;

    /**
     * Fully-qualified model class name
     */
    protected $model = Answer::class;

    /**
     * The number of results to return per page.
     */
    public function limit(): int
    {
        return 500;
    }

    /**
     * The attributes that are used for searching.
     *
     * @return array
     */
    public function searchableBy(): array
    {
        return ['observation', 'ip_client'];
    }

    /**
     * The attributes that are used for sorting.
     *
     * @return array
     */
    public function sortableBy(): array
    {
        return [
            'id',
            'qualified_score',
            'score_auto',
            'ip_client',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * The attributes that are used for filtering.
     *
     * @return array
     */
    public function filterableBy(): array
    {
        return [
            'question_option_id',
            'client_id',
            'tried',
            'user_id_qualifier',
            'user_id',
            'qualified_score',
            'score_auto',
            'questionOption.question.formSection.form_id',
            'questionOption.question.formSection.id',
        ];
    }

    /**
     * The relations that are allowed to be included together with a resource.
     *
     * @return array
     */
    public function includes(): array
    {
        return [
            'questionOption',
            'questionOption.question',
            'questionOption.question.formSection',
            'client',
            'user',
            'qualifier'
        ];
    }
    /**
     * The request class to use for store and update operations.
     *
     * @return string
     */
    protected function request(): string
    {
        return AnswerRequest::class;
    }

    /**
     * Enviar resultados del test por email con iframe
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResults(Request $request)
    {
        // Validar datos de entrada
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|integer|exists:clients,id',
            'email' => 'required|email|max:255',
            'form_name' => 'required|string|max:255',
            'results_url' => 'required|url|max:500'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Datos de entrada inválidos',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Obtener información del cliente
            $client = Client::findOrFail($request->client_id);

            // Validar que la URL pertenezca a dominios permitidos (seguridad)
            $allowedDomains = [
                'localhost',
                '127.0.0.1',
                'test-autoestima.dylgsolutionssac.net.pe', // Tu dominio de producción
                'test-coopersmith.netlify.app' // Ejemplo si usas Netlify
            ];

            $urlDomain = parse_url($request->results_url, PHP_URL_HOST);
            if (!in_array($urlDomain, $allowedDomains)) {
                return response()->json([
                    'success' => false,
                    'message' => 'URL no permitida por seguridad'
                ], 403);
            }

            // Enviar email con iframe
            Mail::to($request->email)->send(
                new TestCompletedMail(
                    clientName: $client->name ?? $client->nombres . ' ' . $client->apellidos,
                    clientEmail: $request->email,
                    formName: $request->form_name,
                    resultsUrl: $request->results_url
                )
            );

            // Log para auditoría
            Log::info('Email de resultados enviado', [
                'client_id' => $request->client_id,
                'email' => $request->email,
                'form_name' => $request->form_name,
                'results_url' => $request->results_url,
                'sent_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Email con resultados enviado exitosamente',
                'data' => [
                    'email' => $request->email,
                    'client_name' => $client->name ?? $client->nombres . ' ' . $client->apellidos,
                    'form_name' => $request->form_name,
                    'sent_at' => now()->format('Y-m-d H:i:s')
                ]
            ]);

        } catch (\Exception $e) {
            // Log del error
            Log::error('Error enviando email de resultados', [
                'error' => $e->getMessage(),
                'client_id' => $request->client_id,
                'email' => $request->email,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error interno al enviar el email',
                'error' => config('app.debug') ? $e->getMessage() : 'Error interno del servidor'
            ], 500);
        }
    }


}

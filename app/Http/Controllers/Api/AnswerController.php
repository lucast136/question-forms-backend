<?php

namespace App\Http\Controllers\Api;

use Orion\Http\Controllers\Controller;
use App\Models\Answer;
use App\Http\Requests\AnswerRequest;
use Orion\Concerns\DisableAuthorization;
use Illuminate\Http\Request;

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


}

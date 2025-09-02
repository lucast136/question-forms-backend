<?php

namespace App\Http\Controllers\api;

use App\Models\Module;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\Controller;
use Orion\Http\Requests\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class ModuleController extends Controller
{
    use DisableAuthorization;

    protected $model = Module::class;

    public function limit() : int
    {
        return 50;
    }

    public function filterableBy():array
{
    return ['name','id'];
}

   /**
     * @return array
     */
    public function rules(Request $request): array
    {
        return [
            'name' => 'required|string|min:1|max:45',
            // 'description' => 'required|string|min:1|max:145',
            // 'status' => 'required|boolean',
            // Agrega aquí más campos según sea necesario
        ];
    }

    /**
     * @param Request $request
     * @param int|string|null $key
     * @return array
     * @throws ValidationException
     */
    protected function beforeSave(Request $request, $key = null): array
    {
        $data = $request->all();

        $validator = Validator::make($data, $this->rules($request));

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $data;
    }
}

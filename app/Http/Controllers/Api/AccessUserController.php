<?php

namespace App\Http\Controllers\api;

use App\Models\AccessUser;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\Controller;
use Orion\Http\Requests\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class AccessUserController extends Controller
{
use DisableAuthorization;

protected $model = AccessUser::class;

public function limit() : int
{
return 50;
}

public function searchableBy(): array
{
return ['name', /*'description'*/];
}
/**
* @return array
*/
public function rules(Request $request): array
{
return [
'mains_id' => 'required|integer',
'users_id' => 'required|integer',
'access' => 'required|boolean|max:1',
'permissions' => 'required|string|max:800',
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
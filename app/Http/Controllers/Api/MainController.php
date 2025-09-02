<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\MainRequest;
use App\Models\Module;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\RelationController;

class MainController extends RelationController
{
use DisableAuthorization;

protected $model = Module::class;

protected $relation = 'mains';

public function limit() : int
{
return 50;
}

/**
    * The attributes that are used for filtering.
    *
    * @return array
    */
    public function filterableBy() : array
    {
        return ['name'];
    }

protected function request()
{
    return MainRequest::class;
}

}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\TypeResource;
use App\Models\Type;

class TypeController extends BaseController
{

    public function __construct(Type $type)
    {
        parent::__construct($type);
    }

    public function index()
    {
        $types = $this->model->get();
        $types = TypeResource::collection($types);

        return $this->returnResponse($types);
    } 
}

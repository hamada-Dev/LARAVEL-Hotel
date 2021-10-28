<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BranchResource;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends BaseController
{

    public function __construct(Branch $branch)
    {
        parent::__construct($branch);
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = $this->model->get();
        $branches = BranchResource::collection($branches);

        return $this->returnResponse($branches);
    } 

}
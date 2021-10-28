<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
class CategoryController extends BaseController
{

    public function __construct(Category $category)
    {
        parent::__construct($category);
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->model->with('child')->whereNull('parent_id')->get();
        $categories = CategoryResource::collection($categories);

        return $this->returnResponse($categories);
    }  
    
    
    public function subCategory($id)
    {
        $categories = $this->model->where('parent_id', $id)->get();
        $categories = CategoryResource::collection($categories);

        return $this->returnResponse($categories);
    }
}

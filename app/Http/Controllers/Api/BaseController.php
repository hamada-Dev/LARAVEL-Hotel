<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BaseController extends Controller
{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;  // commit this -> middleware becouse user this app as guest
        // $this->middleware(['permission:read-'   . $this->getClassNameFromModel()])->only('index');
        // $this->middleware(['permission:create-' . $this->getClassNameFromModel()])->only('store');
        // $this->middleware(['permission:update-' . $this->getClassNameFromModel()])->only('update');
        // $this->middleware(['permission:delete-' . $this->getClassNameFromModel()])->only('destroy');
    }

    public function sendResponse($data, $message, $code = 200)
    {
        $response = [
            'success' => true,
            'data'    => $data,
            'message' => $message,
        ];
        return response()->json($response, $code);
    } //end of function sentResponse

    public function sendError($message, $code = 200)
    {
        $response = [
            'success' => false,
            'data'    => null,
            'message' => $message,
        ];
        return response()->json($response, $code);
    }

    public function returnResponse($data, $sucessMessage = 'success', $failMessage = 'nodata'){
        if(count($data) < 1){
            return $this->sendError($failMessage);
        }else{
            return $this->sendResponse($data, $sucessMessage);
        }
    }

    public function getClassNameFromModel()
    {
        return Str::plural($this->getSingularModelName());
    } //end of get class name

    public function getSingularModelName()
    {

        return strtolower(class_basename($this->model));
    } //end of get singular model name
}

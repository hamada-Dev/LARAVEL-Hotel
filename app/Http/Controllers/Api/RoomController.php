<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\RoomResource;
use App\Models\Room;


class RoomController extends BaseController
{

    public function __construct(Room $room)
    {
        parent::__construct($room);
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roomes = $this->model->with('types', 'branches', 'features')->get();
        
        // return $roomes;

        $roomes = RoomResource::collection($roomes);

        return $this->returnResponse($roomes);
    } 
}

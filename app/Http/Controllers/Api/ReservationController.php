<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\ReservationDetail;
use App\Models\Room;
use App\Traits\CheckRoomTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends BaseController
{
    use CheckRoomTrait {
        CheckRoomTrait::__construct as private __checkRoomConstruct;
    }

    protected $room;
    protected $reserveDetail;

    public function __construct(Reservation $model, Room $room, ReservationDetail $reserveDetail)
    {
        parent::__construct($model);
        $this->room             = $room;
        $this->reserveDetail    = $reserveDetail;
        $this->__checkRoomConstruct($room, $reserveDetail);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $errorArray = array();

        $reserveJson   = json_decode(file_get_contents("php://input"), true);


        foreach ($reserveJson['reservationData'] as $index => $request) {

            
            $nuberOfPerson =  $this->checkRoomPlace($request);
            $checkVal      = $this->checkAvilablePlaceInThisDate($nuberOfPerson, $request['room_id']);

            if ($checkVal['status']) {
                if ($checkVal['avilable'] < $request['person_number']) {
                    $errorArray[] = "you want to Reservation {$request['person_number']} and avilabel is {$checkVal['avilable']} ";
                }
            } else {
                $errorArray[]  = "you want to Reservation {$request['person_number']} and avilabel is {$checkVal['avilable']} ";
            }
        }// end check in all roomes avialbe 

        // return $errorArray;

        if (empty($errorArray)) {

            try {
                DB::beginTransaction();

                $reserve = $this->model->create(['user_id' => 1, 'paid' => $reserveJson['userData']['paid']]);

                foreach ($reserveJson['reservationData'] as $index => $request) {
                    $reserve->reservationsDetails()->create([
                        'room_id'       => $request['room_id'],
                        'person_number' => $request['person_number'],
                        'start_at'      => $request['start_at'],
                        'end_at'        => $request['end_at'],
                        'price'         => $request['person_number'] == $checkVal['max_person'] ? $checkVal['room_price'] : $checkVal['person_price'] * $request['person_number']
                    ]);
                }
                DB::commit();
                return $this->sendResponse($reserve->id, 'success');
            } catch (\Exception $ex) {
                DB::rollback();
            }
        } else {
            return $this->sendError($errorArray);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

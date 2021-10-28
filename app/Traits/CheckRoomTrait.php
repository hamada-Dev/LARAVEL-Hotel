<?php

namespace App\Traits;

use App\Models\ReservationDetail;
use App\Models\Room;

trait CheckRoomTrait{

    protected $room;
    protected $reserveDetail;

    public function __construct(Room $room, ReservationDetail $reserveDetail)
    {
        $this->room          = $room;
        $this->reserveDetail = $reserveDetail;
    }


    public function checkRoomPlace($request)
    {
        $from = date('Y-m-d', strtotime($request->start_at));
        $to   = date('Y-m-d', strtotime($request->end_at));

        $num =  $this->reserveDetail
            ->where('room_id', $request->room_id)
            ->whereBetween('start_at',  [$from, $to])
            ->OrwhereBetween('end_at',  [$from, $to])
            ->get()->sum('person_number');

        return $num;
    }

    public function checkAvilablePlaceInThisDate($personNum, $roomId)
    {
        $maxNumebrOfPerson = $this->room->find($roomId);
        $data = ['avilable' => 0, 'status' => false, 'max_person' => $maxNumebrOfPerson->person_number, 'room_price' => $maxNumebrOfPerson->room_price, 'person_price' => $maxNumebrOfPerson->person_price];
        if ($personNum < $maxNumebrOfPerson->person_number) {
            $data = ['avilable' => $maxNumebrOfPerson->person_number - $personNum, 'status' => true, 'max_person' => $maxNumebrOfPerson->person_number, 'room_price' => $maxNumebrOfPerson->room_price, 'person_price' => $maxNumebrOfPerson->person_price];
        }
        return $data;
    }

}
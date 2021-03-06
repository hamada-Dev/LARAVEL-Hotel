<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\ReservationDetail;
use App\Models\Room;
use App\Traits\CheckRoomTrait;
use Illuminate\Http\Request;

class ReservationController extends BackEndController
{   
    use CheckRoomTrait{
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationRequest $request)
    {
        // return $request;
        $nuberOfPerson =  $this->checkRoomPlace($request); // this method return number of person in this room at date Between 

        $checkVal      = $this->checkAvilablePlaceInThisDate($nuberOfPerson, $request->room_id);

        if ($checkVal['status']) {
            if ($checkVal['avilable'] < $request->person_number) {
                return redirect()->back()->withInput()->with(['error' => "you want to Reservation $request->person_number and avilabel is {$checkVal['avilable']} "]);
            }
        } else {
            return redirect()->back()->withInput()->with(['error' => "you want to Reservation $request->person_number and avilabel is {$checkVal['avilable']} "]);
        }


        $request_reserve             =  $request->only(['user_id', 'paid']);
        $request_reserve['added_by'] =  $this->userId;
        if ($request->image) {
            $request_reserve['image'] = $this->uploadImage($this->getSingularModelName(), $request->image);
        }


        $request_reserve_detail            =  $request->only(['room_id', 'person_number', 'start_at', 'end_at',]);
        $request_reserve_detail['price']   = $request->person_number == $checkVal['max_person'] ? $checkVal['room_price'] : $checkVal['person_price'] * $request->person_number;

        $reserve = $this->model->create($request_reserve);

        $reserve->reservationsDetails()->create($request_reserve_detail);

        session()->flash('success', __('site.add_successfuly'));
        return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
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
    public function update(ReservationRequest $request, $id)
    {
        return 'time ';
    }

    public function destroy($id, Request $request)
    {
        return 'time ';
    }
}
